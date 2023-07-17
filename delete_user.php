<?php
session_start();

require_once 'includes/common.php';


if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete the user from the database
    $deleteQuery = "DELETE FROM users WHERE user_id= '$userId'";
    mysqli_query($con, $deleteQuery);

    // Redirect back to the useradmin.php page
    header('Location: useradmin.php');
    exit();
} else {
    // Redirect to the useradmin.php page if the user ID is not provided
    header('Location: useradmin.php');
    exit();
}
?>
