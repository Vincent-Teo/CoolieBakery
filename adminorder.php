<?php

session_start();

// Assuming you have a database connection
require_once 'includes/common.php';

// Retrieve all orders with product and user information
$query = "SELECT o.order_id, o.order_date, o.quantity, p.id, p.name, u.user_id, CONCAT(u.first_name, ' ', u.last_name) AS user_name, u.phone, u.address
          FROM orders o
          INNER JOIN products p ON o.id = p.id
          INNER JOIN users u ON o.user_id= u.user_id
          WHERE o.status = 'Confirm'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'admin_navbar.php'; ?>
<div class="container">
    <h1>Admin Orders</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>User Name</th>
            <th>Product Name</th>
            <th>Order Quantity</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Loop through the orders and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['order_id'] . '</td>';
            echo '<td>' . $row['order_date'] . '</td>';
            echo '<td>' . $row['user_name'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['quantity'] . '</td>';
            echo '<td>' . $row['phone'] . '</td>';
            echo '<td>' . $row['address'] . '</td>';

            // Add Edit and Delete buttons with appropriate links or actions
            echo '<td>';
            echo '<button onclick="confirmUpdate(' . $row['order_id'] . ')" class="btn btn-success">Order Delivered</button>';
            echo ' ';
            echo '<button onclick ="confirmDelete(' . $row['order_id'] . ')" class = "btn btn-danger"> Delete Order</button>';
            echo '</td>';

            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // JavaScript function to display a confirmation dialog before deleting an order
    function confirmUpdate(order_id) {
        if (confirm("Are you sure you want to confirm this order?")) {
            window.location.href = "update_order.php?id=" + order_id;
        }
    }

    function confirmDelete(order_id){
        if(confirm("Are you sure you want to delete this order?")){
            window.location.href ="delete_order.php?id=" + order_id;
        }
    }
</script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>
