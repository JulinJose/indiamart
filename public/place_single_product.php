<?php
header("Content-Type: application/json");

include "auth.php";

/* ---------------- AUTH ---------------- */
$user = authUser($db);
$user_id = (int)($user['id'] ?? 0);

if ($user_id <= 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Unauthorized"
    ]);
    exit;
}

/* ---------------- INPUT ---------------- */
$input = json_decode(file_get_contents("php://input"), true);

$product_id = (int)($input['product_id'] ?? 0);
$quantity   = (int)($input['quantity'] ?? 1);

if ($product_id <= 0 || $quantity <= 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid product or quantity"
    ]);
    exit;
}

/* ---------------- PRODUCT FETCH (NO STOCK CHECK) ---------------- */
$product_q = mysqli_query(
    $db,
    "SELECT id, name, new_price 
     FROM products 
     WHERE id = $product_id"
);

$product = mysqli_fetch_assoc($product_q);

if (!$product) {
    echo json_encode([
        "status" => "error",
        "message" => "Product not found"
    ]);
    exit;
}

/* ---------------- CALCULATION ---------------- */
$total_amount = $product['new_price'] * $quantity;

/* ---------------- CREATE ORDER ---------------- */
mysqli_begin_transaction($db);

try {

    // Insert into orders table
    mysqli_query($db, "
        INSERT INTO orders (
            user_id,
            total_amount,
            status,
            created_at
        ) VALUES (
            $user_id,
            $total_amount,
            'pending',
            NOW()
        )
    ");

    $order_id = mysqli_insert_id($db);

    // Insert into order_items table
    mysqli_query($db, "
        INSERT INTO order_items (
            order_id,
            product_id,
            quantity,
            price
        ) VALUES (
            $order_id,
            $product_id,
            $quantity,
            {$product['new_price']}
        )
    ");

    mysqli_commit($db);

} catch (Throwable $e) {

    mysqli_rollback($db);

    echo json_encode([
        "status" => "error",
        "message" => "Order failed"
    ]);
    exit;
}

/* ---------------- MERCHANT KEY ---------------- */
/*
  Paynimo:
  merchant_key == merchantCode
  SAFE to expose
*/
$merchant_key = "T206030";

/* ---------------- RESPONSE ---------------- */
echo json_encode([
    "status"       => "success",
    "order_id"     => $order_id,
    "merchant_key" => $merchant_key
]);

exit;
