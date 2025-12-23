<?php
header("Content-Type: application/json");
include "../admin/connection.php";
require 'vendor/autoload.php'; // if using composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$input = json_decode(file_get_contents("php://input"), true);
$username = trim($input['username'] ?? '');

if (empty($username)) {
    echo json_encode(["status" => "error", "message" => "Username required"]);
    exit;
}

$sql = "SELECT id, email, phone FROM users WHERE email='$username' OR phone='$username' LIMIT 1";
$res = mysqli_query($db, $sql);
$user = mysqli_fetch_assoc($res);

if (!$user) {
    echo json_encode(["status" => "error", "message" => "User not found"]);
    exit;
}

$otp = rand(100000, 999999);
$expires_at = date("Y-m-d H:i:s", strtotime("+10 minutes"));

mysqli_query($db, "INSERT INTO password_resets (user_id, otp, expires_at, used) 
                   VALUES ({$user['id']}, '$otp', '$expires_at', 0)");

if (!empty($user['email'])) {

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings (Gmail Example)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mail2soumyavs@gmail.com';
        $mail->Password   = 'rupb bknw hnsg cljw'; // NOT Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       =  587;

        $mail->setFrom('YOUR_GMAIL@gmail.com', 'Password Reset');
        $mail->addAddress($user['email']);

        $mail->Subject = "Password Reset OTP";
        $mail->Body    = "Your OTP is: $otp (valid for 10 minutes)";

        $mail->send();
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Failed to send email"]);
        exit;
    }
}

echo json_encode(["status" => "success", "message" => "OTP sent successfully"]);
exit;
