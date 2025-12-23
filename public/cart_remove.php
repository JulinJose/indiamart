<?php
header("Content-Type: application/json");
include "auth.php";

$user = authUser($db);
$input = json_decode(file_get_contents("php://input"), true);

$product_id = (int)($input['product_id'] ?? 0);

if ($product_id <= 0) {
    echo json_encode(["status"=>"error","message"=>"Product ID required"]);
    exit;
}

$delete = mysqli_query($db, "DELETE FROM cart WHERE user_id={$user['id']} AND product_id=$product_id");

if ($delete) {
    echo json_encode(["status"=>"success","message"=>"Product removed from cart"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Failed to remove product"]);
}
?>
