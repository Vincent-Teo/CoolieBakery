<?php
require "includes/common.php";
session_start();

$email = $_POST['eMail'];
$email = mysqli_real_escape_string($con, $email);

$pass = $_POST['password'];
$pass = mysqli_real_escape_string($con, $pass);
$pass = md5($pass);

$first = $_POST['firstName'];
$first = mysqli_real_escape_string($con, $first);

$last = $_POST['lastName'];
$last = mysqli_real_escape_string($con, $last);

$phoneNumber = $_POST['phoneNumber']; // Add the phone number field
$phoneNumber = mysqli_real_escape_string($con, $phoneNumber);

$address = $_POST['address'];
$address = mysqli_real_escape_string($con, $address);

$level = $_POST['level']; // Get the selected level from the form

$query = "SELECT * FROM users WHERE email_id='$email'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if ($num != 0) {
    $m = "Email Already Exists";
    header('location: index.php?error=' . $m);
} else {
    $quer = "INSERT INTO users(email_id, first_name, last_name, password, phone, address, level) VALUES ('$email', '$first', '$last', '$pass', '$phoneNumber', '$address', '$level')";
    mysqli_query($con, $quer);

    $user_id = mysqli_insert_id($con);
    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $user_id;

    if ($level == 1) {
        header('location: admin.php');
    } else {
        header('location: index.php');
    }
}
?>
