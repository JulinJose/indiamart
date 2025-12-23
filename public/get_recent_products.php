<?php
header("Content-Type: application/json");
include "auth.php"; 

$user = authUser($db);
$user_id = $user['id'] ?? 0;
$sql = "SELECT 
            p.id AS product_id,
            p.name,
            p.description,
            p.new_price,
            p.stock,
            p.img,
            p.cid AS category_id,
            w.t1 AS weight_name
        FROM products p
        LEFT JOIN weight w ON p.wid = w.id
        ORDER BY p.id DESC
        LIMIT 6";

$result = mysqli_query($db, $sql);

if (!$result) {
    echo json_encode(["status" => "error", "message" => "Database query failed"]);
    exit;
}
$fav_ids = [];
if ($user_id > 0) {
    $fav_query = mysqli_query($db, "SELECT product_id FROM favourites WHERE user_id = $user_id");
    while ($fav = mysqli_fetch_assoc($fav_query)) {
        $fav_ids[] = (int)$fav['product_id'];
    }
}


$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $product_id = (int)$row['product_id'];
    $products[] = [
        "product_id"   => $product_id,
        "name"         => $row['name'],
        "description"  => $row['description'],
        "price"        => (float)$row['new_price'],
        "stock"        => (int)$row['stock'],
        "weight"       => $row['weight_name'] ?? null,
        "category_id"  => (int)$row['category_id'],
        "image"        => "https://design-pods.com/indiamart/admin/assets/images/products/" . $row['img'],
        "is_favourite" => in_array($product_id, $fav_ids)
    ];
}

echo json_encode([
    "status" => "success",
    "total_products" => count($products),
    "products" => $products
]);
exit;
?>
