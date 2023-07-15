<?php
require "includes/common.php";
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Delete the rows from the users_products table where item_id and user_id are equal to the item_id and user_id obtained from the cart page and session
    $query = "DELETE FROM users_products WHERE item_id='$item_id' AND user_id='$user_id'";
    mysqli_query($con, $query);
    header("location: cart.php");
    exit();
} else {
    header("location: cart.php");
    exit();
}
?>

