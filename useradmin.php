<?php
session_start();

require_once 'includes/common.php';

// Retrieve non-admin users from the database
$userQuery = "SELECT user_id, CONCAT(first_name, ' ', last_name) AS user_name, level FROM users WHERE level != 1";
$userResult = mysqli_query($con, $userQuery);

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'admin_navbar.php'; ?>
<div class="container">
    <h1>User Administration</h1>
    <table class="table">
        <thead>
        <tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>User Level</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($userResult)) { ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['level']; ?></td>
                <td>
                    <a href="edituser.php?id=<?php echo $row['user_id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="delete_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger" onclick="return confirmDelete()">Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this user?");
    }
</script>
</body>
</html>
