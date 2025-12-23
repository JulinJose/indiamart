<?php
header("Content-Type: application/json");
include "../admin/connection.php";

$input = json_decode(file_get_contents("php://input"), true);

$name     = $input['name'] ?? '';
$email    = $input['email'] ?? '';
$password = $input['password'] ?? '';
$phone    = $input['phone'] ?? '';
// $address  = $input['address'] ?? '';

if (empty($name) || empty($email) || empty($password) || empty($phone)) {
    echo json_encode(["status"=>"error", "message"=>"All fields are required"]);
    exit;
}

// check if email already exists
$check = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    echo json_encode(["status"=>"error", "message"=>"Email already registered"]);
    exit;
}

// hash password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// insert user
$insert = mysqli_query($db, "INSERT INTO users (name, email, password, phone) 
                             VALUES ('$name','$email','$hashedPassword','$phone')");

if ($insert) {
    echo json_encode([
        "status" => "success", 
        "message" => "User registered successfully",
        "user" => [
            "id"      => mysqli_insert_id($db),
            "name"    => $name,
            "email"   => $email,
            "phone"   => $phone
            // "address" => $address
        ]
    ]);
} else {
    echo json_encode(["status"=>"error", "message"=>"Registration failed"]);
}
exit;
?>
