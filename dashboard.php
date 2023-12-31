<?php
// Start session
session_start();

require_once 'includes/common.php';

// Retrieve the total number of orders
$totalOrdersQuery = "SELECT COUNT(*) AS total_orders FROM `orders` WHERE status = 'Complete'";
$totalOrdersResult = mysqli_query($con, $totalOrdersQuery);
$totalOrders = mysqli_fetch_assoc($totalOrdersResult)['total_orders'];

// Retrieve the total number of users
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM `users` WHERE level = 0";
$totalUsersResult = mysqli_query($con, $totalUsersQuery);
$totalUsers = mysqli_fetch_assoc($totalUsersResult)['total_users'];

// Retrieve the total number of products
$totalProductsQuery = "SELECT COUNT(*) AS total_products FROM `products`";
$totalProductsResult = mysqli_query($con, $totalProductsQuery);
$totalProducts = mysqli_fetch_assoc($totalProductsResult)['total_products'];

// Retrieve the total product sales and profit
$totalSalesQuery = "SELECT SUM(total) AS total_profit FROM `sales`";
$totalSalesResult = mysqli_query($con, $totalSalesQuery);
$totalSalesData = mysqli_fetch_assoc($totalSalesResult);
$totalProfit = $totalSalesData['total_profit'];

// Retrieve the total number of orders that is not delivered
$totalOrdersNewQuery = "SELECT COUNT(*) AS total_orders_new FROM `orders` WHERE status = 'Confirm'";
$totalOrdersNewResult = mysqli_query($con, $totalOrdersNewQuery);
$totalOrdersNew = mysqli_fetch_assoc($totalOrdersNewResult)['total_orders_new'];

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional CSS styles */
        .custom-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include 'admin_navbar.php'; ?>
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text"><?php echo $totalUsers; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text"><?php echo $totalProducts; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text"><?php echo $totalOrdersNew; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title">Total Orders(Delivered)</h5>
                    <p class="card-text"><?php echo $totalOrders; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body">
                    <h5 class="card-title">Total Profit</h5>
                    <p class="card-text"><?php echo 'RM ' . $totalProfit; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>