<?php
header("Content-Type: application/json");
include "auth.php"; // to authenticate user

// Authenticate logged-in user
$user = authUser($db);
$user_id = $user['id'] ?? 0;

if ($user_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

// Read input JSON
$input = json_decode(file_get_contents("php://input"), true);

// Allowed fields
$name     = $input['name'] ?? '';
$email    = $input['email'] ?? '';
$phone    = $input['phone'] ?? '';
$password = $input['password'] ?? '';
// $address  = $input['address'] ?? '';
// $address2 = $input['address2'] ?? '';

// Build dynamic update query
$updates = [];

if (!empty($name)) $updates[] = "name = '" . mysqli_real_escape_string($db, $name) . "'";
if (!empty($email)) $updates[] = "email = '" . mysqli_real_escape_string($db, $email) . "'";
if (!empty($phone)) $updates[] = "phone = '" . mysqli_real_escape_string($db, $phone) . "'";
// if (!empty($address)) $updates[] = "address = '" . mysqli_real_escape_string($db, $address) . "'";
// if (!empty($address2)) $updates[] = "address2 = '" . mysqli_real_escape_string($db, $address2) . "'";
if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $updates[] = "password = '$hashed'";
}

// If no data provided
if (empty($updates)) {
    echo json_encode(["status" => "error", "message" => "No fields to update"]);
    exit;
}


// Final query
$sql = "UPDATE users SET " . implode(", ", $updates) . " WHERE id = $user_id";
$update = mysqli_query($db, $sql);

if ($update) {
    // Fetch updated user info
    $query = mysqli_query($db, "SELECT id, name, email, phone, created_at FROM users WHERE id = $user_id");
    $updated_user = mysqli_fetch_assoc($query);

    echo json_encode([
        "status" => "success",
        "message" => "Profile updated successfully",
        "user" => $updated_user
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Profile update failed"
    ]);
}

exit;
?>
