<?php
header("Content-Type: application/json");
include "auth.php";

// Authenticate user
$user = authUser($db);

// Read JSON input
$input = json_decode(file_get_contents("php://input"), true);
$product_id = isset($input['product_id']) ? (int)$input['product_id'] : 0;

if ($product_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid product ID"]);
    exit;
}

// Check if favourite exists
$check = mysqli_query($db, "SELECT * FROM favourites WHERE user_id = {$user['id']} AND product_id = $product_id");
if (mysqli_num_rows($check) === 0) {
    echo json_encode(["status" => "error", "message" => "Product not found in favourites"]);
    exit;
}

// Remove favourite
$delete = mysqli_query($db, "DELETE FROM favourites WHERE user_id = {$user['id']} AND product_id = $product_id");

if ($delete) {
    echo json_encode([
        "status" => "success",
        "message" => "Product removed from favourites",
        "product_id" => $product_id
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to remove from favourites"]);
}
exit;
?>
