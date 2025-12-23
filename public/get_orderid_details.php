<?php
header("Content-Type: application/json");

include "auth.php";

/* ---------------- AUTH ---------------- */
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
$order_id = (int)($input['order_id'] ?? 0);

if ($order_id <= 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Order ID required"
    ]);
    exit;
}

/* ---------------- VERIFY ORDER OWNER ---------------- */
$check = mysqli_query($db, "
    SELECT id 
    FROM orders 
    WHERE id = $order_id AND user_id = $user_id
");

if (mysqli_num_rows($check) === 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Order not found"
    ]);
    exit;
}

/* ---------------- FETCH ORDER PRODUCTS ---------------- */
$item_q = mysqli_query($db, "
    SELECT 
        oi.product_id,
        oi.quantity,
        oi.price,
        p.name,
        p.img
    FROM order_items oi
    JOIN products p ON p.id = oi.product_id
    WHERE oi.order_id = $order_id
");

$products = [];

while ($row = mysqli_fetch_assoc($item_q)) {
    $products[] = [
        "product_id" => (int)$row['product_id'],
        "name"       => $row['name'],
        "price"      => (float)$row['price'],
        "quantity"   => (int)$row['quantity'],
        "total"      => (float)($row['price'] * $row['quantity']),
        "image"      => $row['img']
    ];
}

echo json_encode([
    "status" => "success",
    "order_id" => $order_id,
    "products" => $products
]);

exit;
