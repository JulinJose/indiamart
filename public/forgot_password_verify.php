<?php
header("Content-Type: application/json");
include "../admin/connection.php";

$input = json_decode(file_get_contents("php://input"), true);

$username   = trim($input['username'] ?? '');
$otp        = trim($input['otp'] ?? '');
$new_pass   = trim($input['new_password'] ?? '');

if (empty($username) || empty($otp) || empty($new_pass)) {
    echo json_encode(["status" => "error", "message" => "All fields are required"]);
    exit;
}

// Check user exists
$sql = "SELECT id FROM users WHERE email='$username' OR phone='$username' LIMIT 1";
$res = mysqli_query($db, $sql);
$user = mysqli_fetch_assoc($res);

if (!$user) {
    echo json_encode(["status" => "error", "message" => "User not found"]);
    exit;
}

// Validate OTP
$sql = "SELECT * FROM password_resets 
        WHERE user_id={$user['id']} AND otp='$otp' AND used=0 
        ORDER BY id DESC LIMIT 1";
$res = mysqli_query($db, $sql);
$reset = mysqli_fetch_assoc($res);

if (!$reset) {
    echo json_encode(["status" => "error", "message" => "Invalid OTP"]);
    exit;
}

if (strtotime($reset['expires_at']) < time()) {
    echo json_encode(["status" => "error", "message" => "OTP expired"]);
    exit;
}

// Update password
$hashed = password_hash($new_pass, PASSWORD_BCRYPT);
mysqli_query($db, "UPDATE users SET password='$hashed' WHERE id={$user['id']}");

// Mark OTP as used
mysqli_query($db, "UPDATE password_resets SET used=1 WHERE id={$reset['id']}");

echo json_encode(["status" => "success", "message" => "Password updated successfully"]);
