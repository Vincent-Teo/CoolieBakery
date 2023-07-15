<?php
session_start();


if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}

require_once 'includes/common.php';


$userId = $_SESSION['user_id'];

// Retrieve the cart items for the current user
$cartItemsQuery = "SELECT * FROM users_products WHERE user_id = '$userId'";
$cartItemsResult = mysqli_query($con, $cartItemsQuery);

// Check if the cart is empty
if (mysqli_num_rows($cartItemsResult) === 0) {
    // Redirect to the cart page or any other page
    header("Location: cart.php");
    exit();
}

// Insert the cart items into the order table
while ($row = mysqli_fetch_assoc($cartItemsResult)) {
    $cartId = $row['id'];
    $quantity = $row['quantity'];
    $productId = $row['item_id'];
    $orderTime = date("Y-m-d H:i:s");

    // Insert the order item into the order table with the payment type
    $insertOrderQuery = "INSERT INTO `orders` (order_date, user_id, id, quantity, status) VALUES ('$orderTime', '$userId', '$productId', '$quantity', 'Confirm')";
    mysqli_query($con, $insertOrderQuery);

    // Delete the cart item
    $deleteCartItemQuery = "DELETE FROM users_products WHERE id = '$cartId'";
    mysqli_query($con, $deleteCartItemQuery);
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'includes/header_menu.php'; ?>
<div class="container">
    <h1>Payment Confirmation</h1>
    <p>Your payment has been confirmed.</p>
    <p>Thank you for purchasing!</p>
    <a href="index.php" class="btn btn-primary">Return to Home</a>
</div>
<?php include 'includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
