<?php
session_start();

// Assuming you have a database connection
require_once 'includes/common.php';

if (isset($_POST['delete'])) {
    $contactId = $_POST['contact_id'];

    // Delete the message from the database
    $deleteQuery = "DELETE FROM contact_us WHERE contact_id = ?";
    $stmt = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $contactId);
    mysqli_stmt_execute($stmt);

    // Redirect back to the adminmessages.php page
    header('Location: adminmessage.php');
    exit();
} else {
    // Redirect to the adminmessages.php page if the delete button was not clicked
    header('Location: adminmessage.php');
    exit();
}
?>
