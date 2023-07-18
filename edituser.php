<?php
session_start();

require_once 'includes/common.php';

if (!isset($_GET['id'])) {
    header("Location: useradmin.php");
    exit();
}

$userId = $_GET['id'];

//fetch data from database
$userQuery = "SELECT email_id, first_name, last_name, phone, address FROM users WHERE user_id = '$userId'";
$userResult = mysqli_query($con, $userQuery);
$userData = mysqli_fetch_assoc($userResult);

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phoneNumber = $_POST['phone'];
    $address = $_POST['address'];

    //update data in database
    $updateQuery = "UPDATE users SET email_id = '$email', first_name = '$firstName', last_name = '$lastName', phone = '$phoneNumber', address = '$address' WHERE user_id= '$userId'";
    mysqli_query($con, $updateQuery);

    header("Location: useradmin.php");
    exit();
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'admin_navbar.php'; ?>
    <div class="container">
        <h1>Edit User</h1>
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
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>