<?php
header("Content-Type: application/json");
include "auth.php"; // for user authentication

// Authenticate user
$user = authUser($db);
$user_id = $user['id'] ?? 0;

if ($user_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

// Get input (address ID)
$input = json_decode(file_get_contents("php://input"), true);
$address_id = isset($input['address_id']) ? (int)$input['address_id'] : 0;

if ($address_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid address ID"]);
    exit;
}

// Check if the address belongs to this user
$check = mysqli_query($db, "SELECT id FROM user_addresses WHERE id = $address_id AND user_id = $user_id");
if (mysqli_num_rows($check) === 0) {
    echo json_encode(["status" => "error", "message" => "Address not found or unauthorized"]);
    exit;
}

// Delete address
$delete = mysqli_query($db, "DELETE FROM user_addresses WHERE id = $address_id AND user_id = $user_id");

if ($delete) {
    echo json_encode([
        "status" => "success",
        "message" => "Address removed successfully",
        "address_id" => $address_id
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to remove address"]);
}
exit;
?>
