<?php
header("Content-Type: application/json");
include "auth.php";

$user = authUser($db);
$input = json_decode(file_get_contents("php://input"), true);

// Handle both single and multiple product_ids
$favourites = [];

if (isset($input['product_id'])) {
    // Single product format
    $favourites[] = $input['product_id'];
} elseif (isset($input['favourites']) && is_array($input['favourites'])) {
    // Multiple products format
    foreach ($input['favourites'] as $fav) {
        if (!empty($fav['product_id'])) {
            $favourites[] = (int)$fav['product_id'];
        }
    }
}

if (empty($favourites)) {
    echo json_encode(["status" => "error", "message" => "Product ID(s) required"]);
    exit;
}

$added = [];
foreach ($favourites as $product_id) {
    $check = mysqli_query($db, "SELECT id FROM favourites WHERE user_id={$user['id']} AND product_id=$product_id");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($db, "INSERT INTO favourites (user_id, product_id) VALUES ({$user['id']}, $product_id)");
        $added[] = $product_id;
    }
}

echo json_encode([
    "status" => "success",
    "message" => "Products added to favourites",
    "added_products" => $added
]);
?>

