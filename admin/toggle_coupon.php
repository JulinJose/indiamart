<?php
include "connection.php";

$id = $_GET['id'] ?? 0;
$status = $_GET['status'] ?? '';

if ($id && in_array($status, ['active','inactive'])) {
    mysqli_query($db, "UPDATE coupons SET status='$status' WHERE id=$id");
}

header("Location: coupons.php");
exit;
?>
