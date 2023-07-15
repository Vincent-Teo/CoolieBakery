<?php
session_start();

require_once 'includes/common.php';

// Retrieve non-admin users from the database
$userQuery = "SELECT user_id, first_name, last_name, level FROM users WHERE level != 1";
$userResult = mysqli_query($con, $userQuery);

// Handle user deletion
if (isset($_POST['delete'])) {
    $userId = $_POST['user_id'];

    // Display a confirmation dialog
    echo "<script>
        var confirmed = confirm('Are you sure you want to delete this user?');
        if (confirmed) {
            document.getElementById('delete-form-" . $userId . "').submit();
        }
    </script>";
}

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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>User Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($userResult)) { ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['level']; ?></td>
                        <td>
                            <a href="edituser.php?id=<?php echo $row['user_id']; ?>" class="btn btn-primary">Edit</a>
                            <form id="delete-form-<?php echo $row['user_id']; ?>" method="post" style="display: inline-block;">
                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>