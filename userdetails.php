<?php
session_start();

require_once 'includes/common.php';

$userId = $_SESSION['user_id'];

$userQuery = "SELECT email_id, first_name, last_name, phone, address FROM users WHERE user_id = '$userId'";
$userResult = mysqli_query($con, $userQuery);
$userData = mysqli_fetch_assoc($userResult);

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phoneNumber = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the passwords match
    if ($password === $confirmPassword) {
        
        $password = mysqli_real_escape_string($con, $pass);
        $password= md5($pass);

        $updateQuery = "UPDATE users SET email_id = '$email', first_name = '$firstName', last_name = '$lastName', phone = '$phoneNumber', address = '$address', password = '$hashedPassword' WHERE user_id= '$userId'";
        mysqli_query($con, $updateQuery);

        echo "<script src='js/sweetalert.min.js'></script>";
        echo "<script>setTimeout(function(){ swal({title: 'Changed Successfully', icon: 'success',timer: 3000}).then(function() {window.location = 'userdetails.php';}); }, 1);</script>";

        exit();
    } else {
        echo "<script src='js/sweetalert.min.js'></script>";
        echo "<script>setTimeout(function(){ swal({title: 'Password Do not Match', icon: 'warning',timer: 3000}).then(function() {window.location = 'userdetails.php';}); }, 1);</script>";
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coolie's Bakery - User Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'includes/header_menu.php';
    ?>
    <br><br><br>
    <div class="container">
        <h1>User Details</h1>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $userData['email_id']; ?>">
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $userData['first_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $userData['last_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $userData['phone']; ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="4"><?php echo $userData['address']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>