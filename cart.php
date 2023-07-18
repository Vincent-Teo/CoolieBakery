<?php
require "includes/common.php";
session_start();

if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit;
}

// Get user ID
$user_id = $_SESSION['user_id'];

// Remove item from cart
if (isset($_GET['remove'])) {
    $item_id = $_GET['remove'];
    $delete_query = "DELETE FROM users_products WHERE user_id='$user_id' AND item_id='$item_id'";
    mysqli_query($con, $delete_query);
}

// Update quantity of cart item
if (isset($_POST['update'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $update_query = "UPDATE users_products SET quantity='$quantity' WHERE user_id='$user_id' AND item_id='$item_id'";
    mysqli_query($con, $update_query);
}

// Calculate subtotal, delivery fee, and grand total
$sum = 0;
$delivery_fee = 0;
$grand_total = 0;

//loop through database and fetch neccessary info for counting sum, delivery fee and grand total
$query = "SELECT products.price AS Price, products.id, products.name AS Name, users_products.quantity AS Quantity FROM users_products JOIN products ON users_products.item_id = products.id WHERE users_products.user_id='$user_id'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) >= 1) {
    while ($row = mysqli_fetch_array($result)) {
        $quantity = $row["Quantity"];
        $price = $row["Price"];
        $item_total = $quantity * $price;
        $sum += $item_total;
    }

    $delivery_fee = $sum * 0.05;
    $grand_total = $sum + $delivery_fee;
}

// Set session variables for subtotal, delivery fee, and grand total
$_SESSION['subtotal'] = $sum;
$_SESSION['delivery_fee'] = $delivery_fee;
$_SESSION['grand_total'] = $grand_total;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coolie's Bakery - Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'includes/header_menu.php'; ?>
    <div class="d-flex justify-content-center">
        <div class="col-md-6 my-5 table-responsive p-5">
            <table class="table table-striped table-bordered table-hover">
                <?php
                $disp = null;
                $user_id = $_SESSION['user_id'];
                $query = "SELECT products.price AS Price, products.id, products.name AS Name, users_products.quantity AS Quantity FROM users_products JOIN products ON users_products.item_id = products.id WHERE users_products.user_id='$user_id'";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) >= 1) {
                ?>
                    <thead>
                        <tr>
                            <th>Item Number</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- loop through database and fetch data -->
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            $quantity = $row["Quantity"];
                            $price = $row["Price"];
                            $item_total = $quantity * $price;
                            $id = $row["id"] . ", ";
                            echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["Name"] . "</td>
                                <td>
                                    <form method='POST' action='cart.php'>
                                        <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                                        <input type='number' name='quantity' value='" . $quantity . "' min='1' required>
                                        <button type='submit' name='update' class='btn btn-primary btn-sm'>Update</button>
                                    </form>
                                </td>
                                <td>RM" . $price . "</td>
                                <td>RM" . $item_total . "</td>
                                <td>
                                    <a href='cart.php?remove=" . $row['id'] . "' class='remove_item_link'>Remove</a>
                                </td>
                            </tr>";

                            if ($row["id"] >= 20) {
                                $disp = 1;
                            }
                        }
                        ?>
                    </tbody>
                <?php
                } else {//error message for empty cart
                    echo "<div><img src='images/emptycart.png' class='image-fluid' height='150' width='150'></div><br/>";
                    echo "<div class='text-bold h5'>Add items to the cart first!</div>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-3 my-5 table-responsive p-5">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td>RM <?php echo $sum; ?></td>
                    </tr>
                    <tr>
                        <td>Delivery Fee (5%)</td>
                        <td>RM <?php echo $delivery_fee; ?></td>
                    </tr>
                    <tr>
                        <td>Grand Total</td>
                        <td>RM <?php echo $grand_total; ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="checkout.php" class="btn btn-danger btn-block">Checkout</a>
        </div>
    </div>
    <!-- footer -->
    <?php include 'includes/footer.php'; ?>
    <!-- footer ends -->
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
    $(document).ready(function() {
        if (window.location.href.indexOf('#login') != -1) {
            $('#login').modal('show');
        }
    });
</script>

</html>