<?php
include("connection.php");
$id = $_GET['id']; 
$pid = $_GET['pid'];
mysqli_query($db,"DELETE FROM pro_subimg WHERE id='$id'");
header("Location: products_edit.php?id=$pid");
?>
