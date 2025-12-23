<?php
header("Content-Type: application/json");
include "auth.php";

$user = authUser($db);
$user_id = $user['id'] ?? 0;

// ✅ Fetch user's favourites along with product and weight info
$sql = "SELECT 
            f.id AS favourite_id, 
            p.id AS product_id, 
            p.name, 
            p.new_price, 
            p.img,
            w.t1 AS weight_name
        FROM favourites f 
        JOIN products p ON f.product_id = p.id 
        LEFT JOIN weight w ON p.wid = w.id
        WHERE f.user_id = {$user_id} 
        ORDER BY f.id DESC";

$res = mysqli_query($db, $sql);

if (!$res) {
    echo json_encode([
        "status" => "error",
        "message" => "Database query failed"
    ]);
    exit;
}

$favourites = [];
while ($row = mysqli_fetch_assoc($res)) {
    $favourites[] = [
        "favourite_id" => (int)$row['favourite_id'],
        "product_id"   => (int)$row['product_id'],
        "name"         => $row['name'],
        "price"        => (float)$row['new_price'],
        "weight"       => $row['weight_name'] ?? null, // ✅ from weight table
        "image"        => "https://design-pods.com/indiamart/admin/assets/images/products/" . $row['img'],
        "is_favourite" => true  
    ];
}

// ✅ Final JSON Response
echo json_encode([
    "status" => "success",
    "user_id" => $user_id,
    "total_favourites" => count($favourites),
    "favourites" => $favourites
]);
exit;
?>
