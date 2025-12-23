<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = (int)$_POST['product_id'];
    $stock = (int)$_POST['stock'];

    $sql = "UPDATE products SET stock = $stock WHERE id = $product_id";
    if (mysqli_query($db, $sql)) {
        msg(" successfully Updated","productfilter.php");
        // header("Location: productfilter.php?success=1");
        exit;
    } else {
        echo "Error updating stock: " . mysqli_error($db);
    }
}
?>
