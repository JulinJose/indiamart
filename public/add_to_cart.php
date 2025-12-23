<?php
header("Content-Type: application/json");
// include "connection.php";
include "auth.php";

$user = authUser($db);

$input = json_decode(file_get_contents("php://input"), true);
$products = $input['products'] ?? [];

if (empty($products)) {
    echo json_encode(["status"=>"error","message"=>"Products required"]);
    exit;
}

foreach ($products as $item) {
    $pid = (int)($item['product_id'] ?? 0);
    $qty = (int)($item['quantity'] ?? 1);

    if ($pid <= 0) continue;

    // check if product already in cart
    $check = mysqli_query($db, "SELECT * FROM cart WHERE user_id={$user['id']} AND product_id=$pid");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($db, "UPDATE cart SET quantity = quantity + $qty WHERE user_id={$user['id']} AND product_id=$pid");
    } else {
        mysqli_query($db, "INSERT INTO cart (user_id, product_id, quantity) VALUES ({$user['id']}, $pid, $qty)");
    }
}

echo json_encode(["status"=>"success","message"=>"Products added to cart"]);
?>

