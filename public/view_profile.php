<?php
header("Content-Type: application/json");
include "auth.php";

// Authenticate user
$user = authUser($db);

if (!$user) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

// Fetch all distinct addresses from orders
$address_sql = "
    SELECT DISTINCT address 
    FROM orders 
    WHERE user_id = {$user['id']} 
    ORDER BY created_at DESC
";

// Build response
$response = [
    "status" => "success",
    "profile" => [
        "id" => $user['id'],
        "name" => $user['name'] ?? '',
        "email" => $user['email'] ?? '',
        "phone" => $user['phone'] ?? '',
        "created_at" => $user['created_at'] ?? '',
    ]
];

echo json_encode($response);
?>

