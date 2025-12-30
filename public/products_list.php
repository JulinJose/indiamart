<?php
header("Content-Type: application/json");
include("../admin/connection.php");

// Fetch only products that are in stock
$q = mysqli_query(
    $db,
    "SELECT id, name, img, old_price, new_price, stock 
     FROM products 
     WHERE stock > 0
     ORDER BY id DESC"
);

$products = [];

while ($r = mysqli_fetch_assoc($q)) {
    $products[] = [
        "id" => (int)$r['id'],
        "name" => $r['name'],
        "image" => "https://design-pods.com/indiamart/admin/assets/images/products/" . $r['img'],
        "old_price" => (float)$r['old_price'],
        "new_price" => (float)$r['new_price'],
        "stock" => (int)$r['stock']
    ];
}

echo json_encode([
    "status" => "success",
    "products" => $products
]);
exit;
?>
