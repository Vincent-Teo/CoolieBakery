<?php
require("includes/common.php");
session_start();

$email = $_POST['lemail'];
$email = mysqli_real_escape_string($con, $email);

$password = $_POST['lpassword'];
$password = mysqli_real_escape_string($con, $password);
$password = md5($password);

$query = "SELECT user_id, email_id, password, level FROM users WHERE email_id='" . $email . "' AND password='" . $password . "'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if ($num == 0) {
    $m = "Please enter correct Email address and Password";
    header('location: index.php?errorl=' . $m);
} else {
    $row = mysqli_fetch_array($result);
    $_SESSION['email'] = $row['email_id'];
    $_SESSION['user_id'] = $row['user_id'];

    if ($row['level'] == 1) {
        header('location: dashboard.php');
    } elseif ($row['level'] == 0) {
        header('location: index.php');
    }
}
?>
