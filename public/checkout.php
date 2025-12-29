<?php
header("Content-Type: application/json");

include "auth.php";
include __DIR__ . "/gateway/payment_request.php";

$user = authUser($db);

$user_id     = (int)$user['id'];
$user_email  = $user['email'];
$user_mobile = $user['phone'];

if ($user_id <= 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Unauthorized"
    ]);
    exit;
}

/* ---------------- INPUT ---------------- */
$input = json_decode(file_get_contents("php://input"), true);

$address = trim($input['address'] ?? '');
$payment_method = trim($input['payment_method'] ?? 'Online Payment');
$coupon_code = trim($input['coupon_code'] ?? '');

if ($address === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Delivery address is required"
    ]);
    exit;
}

/* Normalize payment method */
$payment_method = strtolower($payment_method);

if (
    $payment_method === 'cod' ||
    $payment_method === 'cash on delivery' ||
    $payment_method === 'cash_on_delivery'
) {
    $payment_method = 'Cash on Delivery';
} else {
    $payment_method = 'Online Payment';
}


/* ---------------- CART FETCH ---------------- */
$cart_res = mysqli_query($db, "
    SELECT c.product_id, c.quantity, p.new_price, p.stock
    FROM cart c
    JOIN products p ON p.id = c.product_id
    WHERE c.user_id = $user_id
");

$total = 0;
$items = [];

while ($row = mysqli_fetch_assoc($cart_res)) {

    if ($row['stock'] < $row['quantity']) {
        echo json_encode([
            "status" => "error",
            "message" => "Not enough stock for product ID {$row['product_id']}"
        ]);
        exit;
    }

    $subtotal = $row['new_price'] * $row['quantity'];
    $total += $subtotal;
    $items[] = $row;
}

if (empty($items)) {
    echo json_encode([
        "status" => "error",
        "message" => "Cart is empty"
    ]);
    exit;
}

/* ---------------- COUPON ---------------- */

$discount = 0;
$coupon_id = null;

if ($coupon_code !== '') {

    $coupon_q = mysqli_query($db, "
        SELECT * FROM coupons
        WHERE code = '$coupon_code'
        AND status = 'active'
        AND (expiry_date IS NULL OR expiry_date >= CURDATE())
    ");

    $coupon = mysqli_fetch_assoc($coupon_q);

    if (!$coupon) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid coupon"
        ]);
        exit;
    }

    if ($coupon['discount_type'] === 'percent') {
        $discount = ($total * $coupon['discount_value']) / 100;
    } else {
        $discount = $coupon['discount_value'];
    }

    if ($discount > $total) $discount = $total;

    $coupon_id = $coupon['id'];
}

$final_total = $total - $discount;

/* ---------------- STATUS & TXN ---------------- */
if ($payment_method === 'Cash on Delivery') {
    $status = 'received';
    $txn_id = NULL;
} else {
    $status = 'pending';
    $txn_id = "TXN" . time() . rand(100,999);
}

/* ---------------- CREATE ORDER ---------------- */
mysqli_query($db, "
    INSERT INTO orders (
        user_id,
        address,
        payment_method,
        total_amount,
        discount,
        final_amount,
        coupon_id,
        txn_id,
        status,
        created_at
    ) VALUES (
        $user_id,
        '".mysqli_real_escape_string($db, $address)."',
        '$payment_method',
        $total,
        $discount,
        $final_total,
        ".($coupon_id ?: "NULL").",
        ".($txn_id ? "'$txn_id'" : "NULL").",
        '$status',
        NOW()
    )
");

$order_id = mysqli_insert_id($db);

/* ---------------- ORDER ITEMS + STOCK ---------------- */
foreach ($items as $it) {
    mysqli_query($db, "
        INSERT INTO order_items (order_id, product_id, quantity, price)
        VALUES ($order_id, {$it['product_id']}, {$it['quantity']}, {$it['new_price']})
    ");

    mysqli_query($db, "
        UPDATE products 
        SET stock = stock - {$it['quantity']} 
        WHERE id = {$it['product_id']}
    ");
}


// ---- Clear cart ----
mysqli_query($db, "DELETE FROM cart WHERE user_id={$user['id']}");

/* ---------------- CASH ON DELIVERY RESPONSE ---------------- */

if ($payment_method === 'Cash on Delivery') {

    echo json_encode([
        "status"         => "success",
        "message"        => "Order placed successfully",
        "order_id"       => $order_id,
        "payment_method"=> "Cash on Delivery",
        "order_status"  => "received",
        "amount"        => $final_total,
        "customer" => [
            "email"  => $user_email,
            "phone" => $user_mobile
        ]
    ]);
    exit;
}

/* ---------------- ONLINE PAYMENT ---------------- */
$paymentPayload = generatePaynimoRequest([
    "txn_id"    => $txn_id,
    "amount"    => $final_total,
    "custID"    => $user_id,
    "mobNo"     => $user_mobile,
    "email"     => $user_email,
    "returnUrl" => "http://localhost/bk/public/gateway/payment_callback.php",
    "name"      => "Order #$order_id"
]);

echo json_encode([
    "status"         => "success",
    "message"        => "Redirect to payment",
    "order_id"       => $order_id,
    "txn_id"         => $txn_id,
    "payment_method"=> "Online Payment",
    "order_status"  => "pending",
    "amount"        => $final_total,
    "customer" => [
        "email"  => $user_email,
        "phone" => $user_mobile
    ],
    "payment_payload"=> $paymentPayload
]);

exit;
