<?php
require "includes/common.php";
session_start();

$email = $_POST['eMail'];
$email = mysqli_real_escape_string($con, $email);

$password = $_POST['password'];
$password = mysqli_real_escape_string($con, $pass);
$password = md5($pass);

$confirmPassword = $_POST['confirmPassword'];

// Check if passwords match
if ($password !== $confirmPassword) {
    $m = "Passwords do not match";
    header('location: index.php?error=' . $m);
    exit();
}

$first = $_POST['firstName'];
$first = mysqli_real_escape_string($con, $first);

$last = $_POST['lastName'];
$last = mysqli_real_escape_string($con, $last);

$phoneNumber = $_POST['phoneNumber'];
$phoneNumber = mysqli_real_escape_string($con, $phoneNumber);

$address = $_POST['address'];
$address = mysqli_real_escape_string($con, $address);

$query = "SELECT * FROM users WHERE email_id='$email'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if ($num != 0) {
    $m = "Email Already Exists";
    header('location: index.php?error=' . $m);
    exit();
} else {
    $quer = "INSERT INTO users(email_id, first_name, last_name, password, phone, address, level) VALUES ('$email', '$first', '$last', '$hashedPassword', '$phoneNumber', '$address', '0')";
    mysqli_query($con, $quer);

    $user_id = mysqli_insert_id($con);
    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $user_id;

    header('location: index.php');
    exit();
}
?>
