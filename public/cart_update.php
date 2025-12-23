<?php
header("Content-Type: application/json");
include "auth.php";

$user = authUser($db);
$input = json_decode(file_get_contents("php://input"), true);

$product_id = (int)($input['product_id'] ?? 0);
$quantity   = (int)($input['quantity'] ?? 0);

if ($product_id <= 0 || $quantity <= 0) {
    echo json_encode(["status"=>"error","message"=>"Product ID and valid quantity required"]);
    exit;
}

// check if exists
$check = mysqli_query($db, "SELECT * FROM cart WHERE user_id={$user['id']} AND product_id=$product_id");
if (mysqli_num_rows($check) > 0) {
    mysqli_query($db, "UPDATE cart SET quantity=$quantity WHERE user_id={$user['id']} AND product_id=$product_id");
    echo json_encode(["status"=>"success","message"=>"Cart updated successfully"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Product not found in cart"]);
}
?>
