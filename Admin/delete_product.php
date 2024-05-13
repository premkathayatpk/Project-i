<?php
require('header.php');
include '../config.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM product WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo "<script>alert('Delete success');</script>";
    } else {
        echo "<script>alert('Failed to delete product');</script>";
    }
}

header("Location: product.php"); // Redirect back to the products page
exit();
?>
