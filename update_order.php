<?php
session_start();

require_once 'includes/common.php';

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Retrieve the order details
    $query = "SELECT o.order_id, o.quantity, o.status, p.price
              FROM orders o
              INNER JOIN products p ON o.id = p.id
              WHERE o.ORDER_ID = '$orderId' && o.status ='Confirm'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // Copy order details to sales table
    $orderId = $row['order_id'];
    $salesQuantity = $row['quantity'];
    $salesPrice = $row['price'];

    $total = $salesQuantity * $salesPrice;

    $insertQuery = "INSERT INTO sales (order_id, total)
                    VALUES ('$orderId', $total)";
    mysqli_query($con, $insertQuery);

    // Delete the order from the database
    $updateQuery = "UPDATE orders SET status = 'Completed' WHERE order_id = '$orderId'";
    mysqli_query($con, $updateQuery);

    // Redirect to the adminorder.php page
    header('Location: adminorder.php');
    exit();
} else {
    // Redirect to the adminorder.php page if the order ID is not provided
    header('Location: adminorder.php');
    exit();
}
?>
