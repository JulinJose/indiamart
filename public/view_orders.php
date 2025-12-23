<?php
header("Content-Type: application/json");
include "auth.php";

$user = authUser($db);

// Fetch orders of the logged-in user
$sql = "SELECT 
            o.id AS order_id,
            o.total_amount,
            o.discount,
            o.final_amount,
            o.status,
            o.created_at
        FROM orders o
        WHERE o.user_id = {$user['id']}
        ORDER BY o.id DESC";

$res = mysqli_query($db, $sql);

$orders = [];
while ($order = mysqli_fetch_assoc($res)) {
    // Fetch items for each order
    $items_sql = "SELECT 
                      oi.product_id,
                      p.name,
                      p.img,
                      oi.quantity,
                      oi.price
                  FROM order_items oi
                  JOIN products p ON oi.product_id = p.id
                  WHERE oi.order_id = {$order['order_id']}";
    $items_res = mysqli_query($db, $items_sql);

    $items = [];
    while ($it = mysqli_fetch_assoc($items_res)) {
        $items[] = [
            "product_id" => $it['product_id'],
            "name"       => $it['name'],
            "image"      =>"https://design-pods.com/indiamart/admin/assets/images/products/". $it['img'],
            "quantity"   => (int) $it['quantity'],
            "price"      => (float) $it['price']
        ];
    }

    $orders[] = [
        "order_id"     => $order['order_id'],
        "total_amount" => (float) $order['total_amount'],
        "discount"     => (float) $order['discount'],
        "final_amount" => (float) $order['final_amount'],
        "status"       => $order['status'],
        "created_at"   => $order['created_at'],
        "items"        => $items
    ];
}

// Response
echo json_encode([
    "status" => "success",
    "orders" => $orders
]);
?>
