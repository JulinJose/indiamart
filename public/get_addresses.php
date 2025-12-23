<?php
header("Content-Type: application/json");
include "auth.php"; // Authenticate user

// Authenticate user
$user = authUser($db);
$user_id = $user['id'] ?? 0;

if ($user_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

// Fetch all addresses of the user
$sql = "SELECT id, address, address_type, pincode, created_at 
        FROM user_addresses 
        WHERE user_id = $user_id 
        ORDER BY id DESC";

$res = mysqli_query($db, $sql);

if (!$res) {
    echo json_encode(["status" => "error", "message" => "Database query failed"]);
    exit;
}

// Prepare response
$addresses = [];
while ($row = mysqli_fetch_assoc($res)) {
    $addresses[] = [
        "address_id"           => (int)$row['id'],
        "address"      => $row['address'],
        "address_type" => $row['address_type'],
        "pincode"      => $row['pincode'],
        "created_at"   => $row['created_at']
    ];
}

echo json_encode([
    "status" => "success",
    "user_id" => $user_id,
    "total_addresses" => count($addresses),
    "addresses" => $addresses
]);
exit;
?>
