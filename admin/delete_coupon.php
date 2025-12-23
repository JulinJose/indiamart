<?php
include "connection.php";

$id = $_GET['id'] ?? 0;

if ($id) {
    mysqli_query($db, "DELETE FROM coupons WHERE id=$id");
}

header("Location: coupons.php");
exit;
?>
