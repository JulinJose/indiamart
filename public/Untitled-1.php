<?php
header("Content-Type: application/json");

include "auth.php";
include __DIR__ . "/gateway/payment_request.php";

$user = authUser($db);
$user_id = $user['id'] ?? 0;

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
$coupon_code = trim($input['coupon_code'] ?? '');

if ($address === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Delivery address is required"
    ]);
    exit;
}

/* ---------------- CART FETCH ---------------- */
$cart_sql = "
    SELECT c.product_id, c.quantity, p.new_price, p.stock
    FROM cart c
    JOIN products p ON p.id = c.product_id
    WHERE c.user_id = $user_id
";
$cart_res = mysqli_query($db, $cart_sql);

$total = 0;
$items = [];

while ($row = mysqli_fetch_assoc($cart_res)) {
    if ($row['stock'] < $row['quantity']) {
        echo json_encode([
            "status" => "error",
            "message" => "Insufficient stock for product ID {$row['product_id']}"
        ]);
        exit;
    }

    $subtotal = $row['new_price'] * $row['quantity'];
    $total += $subtotal;
    $items[] = $row;
}

if ($total <= 0 || empty($items)) {
    echo json_encode([
        "status" => "error",
        "message" => "Cart is empty"
    ]);
    exit;
}

/* ---------------- COUPON (OPTIONAL) ---------------- */
$discount = 0;
$coupon_id = null;

if ($coupon_code !== '') {
    $coupon_q = mysqli_query($db, "
        SELECT * FROM coupons
        WHERE code='$coupon_code'
        AND status='active'
        AND (expiry_date IS NULL OR expiry_date >= CURDATE())
    ");

    $coupon = mysqli_fetch_assoc($coupon_q);

    if (!$coupon) {
        echo json_encode(["status"=>"error","message"=>"Invalid coupon"]);
        exit;
    }

    if ($coupon['restricted_to_user_id'] && $coupon['restricted_to_user_id'] != $user_id) {
        echo json_encode(["status"=>"error","message"=>"Coupon not valid for you"]);
        exit;
    }

    if ($coupon['usage_limit'] > 0 && $coupon['used_count'] >= $coupon['usage_limit']) {
        echo json_encode(["status"=>"error","message"=>"Coupon limit reached"]);
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

/* ---------------- CREATE ORDER ---------------- */
$txn_id = "TXN" . time() . rand(100,999);

mysqli_query($db, "
    INSERT INTO orders (
        user_id,
        address,
        total_amount,
        discount,
        final_amount,
        coupon_id,
        txn_id,
        status,
        created_at
    ) VALUES (
        $user_id,
        '".mysqli_real_escape_string($db,$address)."',
        $total,
        $discount,
        $final_total,
        ".($coupon_id ?: "NULL").",
        '$txn_id',
        'pending',
        NOW()
    )
");

$order_id = mysqli_insert_id($db);

/* ---------------- PAYNIMO REQUEST ---------------- */
$paymentPayload = generatePaynimoRequest([
    "txn_id"    => $txn_id,
    "amount"    => $final_total,
    "custID"    => $user_id,
    "mobNo"     => "9999999999",
    "email"     => "customer@example.com",
    "returnUrl" => "https://yourdomain.com/public/gateway/payment_callback.php",
    "name"      => "Order #$order_id"
]);

if (isset($paymentPayload['error'])) {
    echo json_encode([
        "status"=>"error",
        "message"=>$paymentPayload['error']
    ]);
    exit;
}

/* ---------------- RESPONSE ---------------- */
echo json_encode([
    "status" => "success",
    "message" => "Order created. Redirect to payment.",
    "order_id" => $order_id,
    "txn_id" => $txn_id,
    "amount" => $final_total,
    "payment_gateway" => "paynimo",
    "payment_payload" => $paymentPayload
]);
exit;