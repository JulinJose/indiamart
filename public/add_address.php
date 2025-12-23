<?php
header("Content-Type: application/json");
include "auth.php"; // to get logged-in user info

// Authenticate user
$user = authUser($db);
$user_id = $user['id'] ?? 0;

if ($user_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

// Get input data
$input = json_decode(file_get_contents("php://input"), true);
$address      = trim($input['address'] ?? '');
$pincode      = trim($input['pincode'] ?? '');
$address_type = trim($input['address_type'] ?? 'Home'); // Default to Home if not given

// Validate inputs
if (empty($address) || empty($pincode)) {
    echo json_encode(["status" => "error", "message" => "Address and pincode are required"]);
    exit;
}

// Insert into user_addresses table
$stmt = $db->prepare("INSERT INTO user_addresses (user_id, address, pincode, address_type) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $user_id, $address, $pincode, $address_type);

if ($stmt->execute()) {
    $address_id = $stmt->insert_id;

    // Fetch newly added address
    $query = mysqli_query($db, "SELECT id, address, pincode, address_type, created_at 
                                FROM user_addresses 
                                WHERE id = $address_id");
    $new_address = mysqli_fetch_assoc($query);

    echo json_encode([
        "status" => "success",
        "message" => "Address added successfully",
        "address" => $new_address
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to add address"]);
}
exit;
?>
