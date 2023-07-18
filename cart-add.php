<?php
require("includes/common.php");
session_start();

if (isset($_POST['product_id']) && is_numeric($_POST['product_id']) && isset($_POST['quantity']) && is_numeric($_POST['quantity'])) {
    $item_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id'];

    //insert neccessary info into cart table
    $query = "INSERT INTO users_products(user_id, item_id, quantity) VALUES('$user_id', '$item_id', '$quantity')";
    mysqli_query($con, $query) or die(mysqli_error($con));
    header('Location: products.php');
    exit();
} else {
    header('Location: products.php');
    exit();
}
?>

