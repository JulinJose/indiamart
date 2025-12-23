<?php
header("Content-Type: application/json");
include_once __DIR__ . '/../connection.php';

$response = $_POST;

$txn_id = $response['txn_id'] ?? '';
$gateway_status = $response['status'] ?? '';

if ($txn_id === '') {
    echo json_encode(["status"=>"error","message"=>"Invalid callback"]);
    exit;
}

if ($gateway_status === "SUCCESS") {
    mysqli_query($db, "
        UPDATE orders 
        SET status='confirmed'
        WHERE txn_id='$txn_id'
    ");
} else {
    mysqli_query($db, "
        UPDATE orders 
        SET status='cancelled'
        WHERE txn_id='$txn_id'
    ");
}

echo json_encode(["status"=>"ok"]);
exit;
