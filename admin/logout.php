<?php
include("connection.php");
$_SESSION['admin']="";
unset($_SESSION['admin']);
header("location:login.php");
?>