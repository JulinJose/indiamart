<?php
header("Content-Type: application/json");
include "../admin/connection.php";

$input = json_decode(file_get_contents("php://input"), true);

$email    = $input['email'] ?? '';
$password = $input['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(["status"=>"error","message"=>"Email and password required"]);
    exit;
}

$res = mysqli_query($db, "SELECT * FROM users WHERE email='$email' LIMIT 1");

if (mysqli_num_rows($res) == 1) {
    $user = mysqli_fetch_assoc($res);

    if (password_verify($password, $user['password'])) {
        $token = bin2hex(random_bytes(32));
        mysqli_query($db, "UPDATE users SET token='$token' WHERE id=".$user['id']);

        echo json_encode([
            "status"=>"success",
            "message"=>"Login successful",
            "token"=>$token,
            "user"=>[
                "id"=>$user['id'],
                "name"=>$user['name'],
                "email"=>$user['email'],
                "phone"=>$user['phone'],
                // "address"=>$user['address'],
            ]
        ]);
    } else {
        echo json_encode(["status"=>"error","message"=>"Invalid password"]);
    }
} else {
    echo json_encode(["status"=>"error","message"=>"User not found"]);
}
exit;
?>
