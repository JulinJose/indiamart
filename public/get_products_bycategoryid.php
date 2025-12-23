<?php
header("Content-Type: application/json");
include "auth.php";

$user = authUser($db);
$user_id = $user['id'] ?? 0;

$category_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($category_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Category ID is required"]);
    exit;
}

//  Fetch products with weight info
$sql = "SELECT 
            p.id, 
            p.name, 
            p.description, 
            p.new_price, 
            p.stock, 
            p.img, 
            p.cid,
            p.wid,
            w.t1 AS weight_name
        FROM products p
        LEFT JOIN weight w ON p.wid = w.id
        WHERE p.cid = $category_id";

$res = mysqli_query($db, $sql);

if (!$res) {
    echo json_encode(["status" => "error", "message" => "Database query failed"]);
    exit;
}

//  Fetch user favourites (to reduce repeated queries)
$fav_ids = [];
if ($user_id > 0) {
    $fav_query = mysqli_query($db, "SELECT product_id FROM favourites WHERE user_id = $user_id");
    while ($fav = mysqli_fetch_assoc($fav_query)) {
        $fav_ids[] = (int)$fav['product_id'];
    }
}

$products = [];
while ($row = mysqli_fetch_assoc($res)) {
    $product_id = (int)$row['id'];

    $products[] = [
        "product_id"   => $product_id,
        "name"         => $row['name'],
        "description"  => $row['description'],
        "price"        => (float)$row['new_price'],
        "stock"        => (int)$row['stock'],
        "weight"       => $row['weight_name'] ?? null, //  From joined weight table
        "image"        => "https://design-pods.com/indiamart/admin/assets/images/products/" . $row['img'],
        "is_favourite" => in_array($product_id, $fav_ids)
    ];
}

//  Send JSON response
echo json_encode([
    "status" => "success",
    "category_id" => $category_id,
    "total_products" => count($products),
    "products" => $products
]);
exit;
?>
