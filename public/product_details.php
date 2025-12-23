<?php
include("../admin/connection.php");
header("Content-Type: application/json");

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "Product ID is required"]);
    exit;
}

$id = intval($_GET['id']);
$q = mysqli_query($db, "
    SELECT p.*, c.name AS category_name, w.t1 AS weight_value 
    FROM products p 
    LEFT JOIN category c ON p.cid = c.id 
    LEFT JOIN weight w ON p.wid = w.id 
    WHERE p.id='$id'
");

if (mysqli_num_rows($q) == 0) {
    echo json_encode(["error" => "Product not found"]);
    exit;
}

$r = mysqli_fetch_assoc($q);

// Fetch sub images
$images = [];
$subQ = mysqli_query($db, "SELECT img FROM pro_subimg WHERE pid='$id'");
while ($sub = mysqli_fetch_assoc($subQ)) {
    $images[] = "https://design-pods.com/indiamart/admin/assets/images/products/" . urlencode($sub['img']);
}
// Add main image as first
array_unshift($images, "https://design-pods.com/indiamart/admin/assets/images/products/" . urlencode($r['img']));

$product = [
    "id"              => $r['id'],
    "name"            => $r['name'],
    "price"           => $r['new_price'],
    "old_price"       => $r['old_price'],
    "stock"           => $r['stock'],
    "category"        => $r['category_name'],
    "weight"          => $r['weight_value'],
    "description"     => $r['description'],
    "care_instruction"=> $r['care_instruction'],
    "return_policy"   => $r['return_policy'],
    "package_info"    => $r['package_info'],
    "manufacturer"    => $r['manufacture'],
    "item_partnumber" => $r['item_partnumber'],
    "images"          => $images
];

echo json_encode($product, JSON_PRETTY_PRINT);
?>
