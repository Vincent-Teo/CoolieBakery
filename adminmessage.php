<?php
session_start();

// Assuming you have a database connection
require_once 'includes/common.php';

// Retrieve all messages from the database
$messagesQuery = "SELECT contact_id, email, name, phonenum, message FROM contact_us";
$messagesResult = mysqli_query($con, $messagesQuery);

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'admin_navbar.php'; ?>
<div class="container">
    <h1>Admin Messages</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Message ID</th>
            <th>Email</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Message</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($messageData = mysqli_fetch_assoc($messagesResult)): ?>
            <tr>
                <td><?php echo $messageData['contact_id']; ?></td>
                <td><?php echo $messageData['email']; ?></td>
                <td><?php echo $messageData['name']; ?></td>
                <td><?php echo $messageData['phonenum']; ?></td>
                <td><?php echo $messageData['message']; ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
