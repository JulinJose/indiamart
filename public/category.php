<?php
header("Content-Type: application/json");
include "auth.php"; 
$user = authUser($db);
$input = json_decode(file_get_contents("php://input"), true);

$result = mysqli_query($db, "SELECT * FROM category");

$categories = [];

while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = [
        "id"   => $row['id'],       // category id
        "name" => $row['name'],     // category name
        "image"=> "https://design-pods.com/indiamart/admin/assets/images/category/" . $row['img'] 
    ];
}

echo json_encode([
    "status" => "success",
    "count"  => count($categories),
    "categories" => $categories
]);
exit;
?>
