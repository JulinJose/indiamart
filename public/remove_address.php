<?php
header("Content-Type: application/json");
include "auth.php"; // to authenticate the logged-in user

// Authenticate user
$user = authUser($db);
$user_id = $user['id'] ?? 0;

if ($user_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents("php://input"), true);
$type = strtolower(trim($input['type'] ?? '')); // can be 'address', 'address2', or 'both'

// Validate
if (!in_array($type, ['address', 'address2', 'both'])) {
    echo json_encode(["status" => "error", "message" => "Invalid type. Use 'address', 'address2', or 'both'"]);
    exit;
}

// Build SQL
if ($type === 'both') {
    $sql = "UPDATE users SET address = NULL, address2 = NULL WHERE id = $user_id";
} elseif ($type === 'address') {
    $sql = "UPDATE users SET address = NULL WHERE id = $user_id";
} else {
    $sql = "UPDATE users SET address2 = NULL WHERE id = $user_id";
}

// Execute
if (mysqli_query($db, $sql)) {
    echo json_encode([
        "status" => "success",
        "message" => ucfirst($type) . " removed successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to remove address"
    ]);
}
exit;
?>
