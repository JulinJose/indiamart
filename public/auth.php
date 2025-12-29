<?php
include "../admin/connection.php";

function authUser($db) {

    $headers = getallheaders();
    $token = '';

    if (!empty($headers['Authorization'])) {
        $token = trim($headers['Authorization']);
    } elseif (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
        $token = trim($_SERVER['HTTP_AUTHORIZATION']);
    } elseif (!empty($_GET['token'])) {
        $token = trim($_GET['token']);
    }

    if ($token === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Missing Authorization token"
        ]);
        exit;
    }

    // Remove "Bearer "
    if (stripos($token, 'Bearer ') === 0) {
        $token = substr($token, 7);
    }

    $token = mysqli_real_escape_string($db, $token);

    $res = mysqli_query(
        $db,
        "SELECT id, name, email, phone 
         FROM users 
         WHERE token='$token' 
         LIMIT 1"
    );

    if ($res && mysqli_num_rows($res) === 1) {
        return mysqli_fetch_assoc($res);
    }

    echo json_encode([
        "status" => "error",
        "message" => "Invalid or expired token"
    ]);
    exit;
}
