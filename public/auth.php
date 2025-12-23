<?php
include "../admin/connection.php";

function authUser($db) {
    $headers = getallheaders();
    $token = '';

    if (isset($headers['Authorization'])) {
        $token = trim($headers['Authorization']);
    } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) { 
        $token = trim($_SERVER['HTTP_AUTHORIZATION']); 
    } elseif (isset($_GET['token'])) { 
        $token = trim($_GET['token']);
    }

    if (!$token) {
        echo json_encode(["status"=>"error","message"=>"Missing Authorization token"]);
        exit;
    }

    // strip Bearer if exists
    if (stripos($token, 'Bearer ') === 0) {
        $token = substr($token, 7);
    }

    $res = mysqli_query($db, "SELECT * FROM users WHERE token='$token' LIMIT 1");

    if ($res && mysqli_num_rows($res) == 1) {
        return mysqli_fetch_assoc($res);
    } else {
        echo json_encode(["status"=>"error","message"=>"Invalid token"]);
        exit;
    }
}
?>
