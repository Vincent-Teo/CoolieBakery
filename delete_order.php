<?php
session_start();

require_once 'includes/common.php';

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Retrieve the order details
    $query = "SELECT o.order_id, o.quantity, p.price
              FROM orders o
              INNER JOIN products p ON o.id = p.id
              WHERE o.ORDER_ID = '$orderId'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    // Delete the order from the database
    $deleteQuery = "DELETE FROM orders WHERE order_id= '$orderId'";
    mysqli_query($con, $deleteQuery);

    // Redirect to the adminorder.php page
    header('Location: adminorder.php');
    exit();
} else {
    // Redirect to the adminorder.php page if the order ID is not provided
    header('Location: adminorder.php');
    exit();
}
?>
