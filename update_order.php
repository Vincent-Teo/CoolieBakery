<?php
session_start();

require_once 'includes/common.php';

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Retrieve the order details
    $query = "SELECT o.order_id, o.quantity, o.status, p.price
              FROM orders o
              INNER JOIN products p ON o.id = p.id
              WHERE o.order_id = ? AND o.status = 'Confirm'";

    // Use prepared statement instead of directly inserting the variable
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $orderId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Copy order details to sales table
    $orderId = $row['order_id'];
    $salesQuantity = $row['quantity'];
    $salesPrice = $row['price'];

    $total = $salesQuantity * $salesPrice;

    $insertQuery = "INSERT INTO sales (order_id, total)
                    VALUES (?, ?)";
    $stmt = mysqli_prepare($con, $insertQuery);
    mysqli_stmt_bind_param($stmt, "sd", $orderId, $total);
    mysqli_stmt_execute($stmt);

    // Delete the order from the database
    $updateQuery = "UPDATE orders SET status = 'Completed' WHERE order_id = ?";
    $stmt = mysqli_prepare($con, $updateQuery);
    mysqli_stmt_bind_param($stmt, "s", $orderId);
    mysqli_stmt_execute($stmt);

    // Redirect to the adminorder.php page
    header('Location: adminorder.php');
    exit();
} else {
    // Redirect to the adminorder.php page if the order ID is not provided
    header('Location: adminorder.php');
    exit();
}
?>
