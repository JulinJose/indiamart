<?php
header("Content-Type: application/x-www-form-urlencoded");
// include_once __DIR__ . '/../connection.php';  // your DB connection
include_once __DIR__ . "/../../admin/connection.php";// if needed (optional for callback)


file_put_contents(
    __DIR__ . '/callback_log.txt',
    date('Y-m-d H:i:s') . "\n" . print_r($_POST, true) . "\n\n",
    FILE_APPEND
);

// -------------------------------
// STEP 1: Capture Callback Data
// -------------------------------
$callbackData = $_POST;  

if (empty($callbackData)) {
    echo json_encode(["status" => "error", "message" => "No callback data received"]);
    exit;
}

$order_id        = $callbackData['orderId'] ?? null;
$txn_id          = $callbackData['txnReferenceNo'] ?? null;
$txn_status      = $callbackData['txnStatus'] ?? null;   // 0300 = Success
$amount_paid     = $callbackData['amount'] ?? 0;
$payment_mode    = $callbackData['paymentMethod'] ?? null;
$response_msg    = $callbackData['message'] ?? '';
$hash            = $callbackData['hash'] ?? null;

// Validate
if (!$order_id || !$txn_status) {
    echo json_encode(["status" => "error", "message" => "Invalid callback details"]);
    exit;
}


// --------------------------------------------------------
// STEP 2: Verify Hash (IMPORTANT - SECURITY)
// --------------------------------------------------------
$secret_key = "3976262521OAOQBJ"; // From Paynimo Dashboard


// Build string in the same sequence provided by Paynimo docs
$hash_string = $order_id . "|" . $txn_id . "|" . $txn_status . "|" . $amount_paid . "|" . $secret_key;
$generated_hash = hash('sha512', $hash_string);

if ($generated_hash !== $hash) {
    echo json_encode(["status" => "error", "message" => "Hash verification failed"]);
    exit;
}


// --------------------------------------------------------
// STEP 3: Update order status in database
// --------------------------------------------------------
$status = ($txn_status == "0300") ? "Success" : "Failed";

$updateOrder = "UPDATE orders SET 
                    status = '$status',
                    txn_id = '$txn_id',
                    final_amount = '$amount_paid'
                WHERE id = $order_id";

mysqli_query($db, $updateOrder);


// --------------------------------------------------------
// STEP 4: Respond to Paynimo or Mobile App
// --------------------------------------------------------
echo json_encode([
    "status" => "success",
    "message" => "Callback processed successfully",
    "order_id" => $order_id,
    "txn_id" => $txn_id,
    "status" => $status
]);

exit;
?>