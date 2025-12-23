<?php
header("Content-Type: application/json");
include("../admin/connection.php");

// Fetch all products
$q = mysqli_query($db,"SELECT id, name, img, old_price, new_price, stock FROM products ORDER BY id DESC");

$products = [];
while($r = mysqli_fetch_assoc($q)) {
    $products[] = [
        "id" => $r['id'],
        "name" => $r['name'],
        "image" => "https://design-pods.com/indiamart/admin/assets/images/products/".$r['img'],
        "old_price" => $r['old_price'],
        "new_price" => $r['new_price'],
        "stock" => $r['stock']
    ];
}

echo json_encode([
    "status" => "success",
    "products" => $products
]);
?>
