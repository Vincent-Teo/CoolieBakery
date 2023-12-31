<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'includes/common.php';

$userId = $_SESSION['user_id'];
$cartId = mysqli_insert_id($con);

$_SESSION['id'] = $cartId;

if (isset($_POST['submit'])) {
    $phoneNumber = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $country = $_POST['country'];

    if (!is_numeric($phoneNumber)) {
        $error = "Phone number should be an integer.";
    } else {
        $fullAddress = $address . ', ' . $city . ', ' . $state . ', ' . $postalCode . ', ' . $country;

        $updateQuery = "UPDATE users SET phone = '$phoneNumber', address = '$fullAddress' WHERE user_id = '$userId'";
        mysqli_query($con, $updateQuery);

        header("Location: payment_confirmation.php");
        exit();
    }
}

// Retrieve the user details from the database
$userQuery = "SELECT phone, address FROM users WHERE user_id = '$userId'";
$userResult = mysqli_query($con, $userQuery);
$userData = mysqli_fetch_assoc($userResult);

mysqli_close($con);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coolie's Bakery - Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'includes/header_menu.php'; ?>
    <br><br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="text-center">Payment Details</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="post" id="payment-form">
                            <div class="row g-3">
                                <div class="col">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">City</label>
                                    <input type="text" class="form-control" id="inputCity" name="city">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">State</label>
                                    <select id="inputState" class="form-select" name="state">
                                        <option selected>Choose...</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Melaka">Melaka</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Pulau Pinang">Pulau Pinang</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Selangor">Selangor</option>
                                        <option value="Terengganu">Terengganu</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="postalCode" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postalCode" name="postalCode">
                                </div>
                                <div class="col-md-6">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Payment Method</label>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="card" id="paymentCard">
                                        <label class="form-check-label" for="paymentCard">
                                            Credit/Debit Card
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="online_banking" id="paymentOnlineBanking">
                                        <label class="form-check-label" for="paymentOnlineBanking">
                                            Online Banking
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-warning btn-lg btn-block">Confirm Order</button>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="text-center">Order Summary</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>RM <?php echo isset($_SESSION['subtotal']) ? $_SESSION['subtotal'] : 0; ?></td>
                                </tr>
                                <tr>
                                    <td>Delivery Fee (5%)</td>
                                    <td>RM <?php echo isset($_SESSION['delivery_fee']) ? $_SESSION['delivery_fee'] : 0; ?></td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td>RM <?php echo isset($_SESSION['grand_total']) ? $_SESSION['grand_total'] : 0; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("payment-form").addEventListener("submit", function(event) {
            var form = event.target;
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add("was-validated");
        });
    </script>

    <?php if (isset($error)) { ?>
        <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
    <?php } ?>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>