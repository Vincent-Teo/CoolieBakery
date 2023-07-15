<!DOCTYPE html>
<?php
require("includes/common.php");
session_start();
if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phonenum = $_POST['phonenum'];
    $message = $_POST['message'];
    $sql_work = "INSERT INTO contact_us (email, name, phonenum, message)
        VALUES ('$email','$name','$phonenum','$message')";
    $con->query($sql_work);
    $sqlid = "SELECT contact_id FROM contact_us ORDER BY contact_id DESC";
    $queryid = $con->query($sqlid);
    $rowid = $queryid->fetch_assoc();
    $_SESSION["contact_id"] = $rowid['contact_id'];

    echo "<script src='js/sweetalert.min.js'></script>";
    echo "<script>setTimeout(function(){ swal({title: 'Submitted', icon: 'success',timer: 3000}).then(function() {window.location = 'contactus.php';}); }, 1);</script>";
}
?>
<html>

<head>
    <title>Contact Us - The Coolie's Bakery</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            background-image: url('images/contactbg.jpg');
            background-size: cover;
            font-family: sans-serif;
            color: #000000;
            line-height: 1.5;
        }

        .container-contact {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding-top: 450px;
            padding-bottom: 600px;
        }

        .contact_information,
        .contact_us {
            width: 600px;
            height: 700px;
            padding: 20px;
            font-size: 150%;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #000000;
            margin-top: 0;
        }

        p {
            margin-bottom: 10px;
        }

        .contact_us h1 {
            margin-top: 0;
        }

        .contact_us table {
            width: 100%;
        }

        .contact_us td.label {
            vertical-align: top;
            padding-top: 8px;
        }

        .contact_us input[type="text"],
        .contact_us input[type="email"],
        .contact_us textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            font-size: 130%;
        }

        .contact_us textarea {
            height: 100px;
        }

        .contact_us input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 130%;
        }

        .contact_us input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }

        .icon {
            margin-right: 5px;
        }

        .icon-green {
            color: green;
        }

        .icon-red {
            color: red;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <?php
    include 'includes/header_menu.php';
    include 'includes/check-if-added.php';
    ?>
    <div class="container-contact">
        <div class="contact_information">
            <h1><b>Contact us</b></h1>
            <hr><br>
            <h2><i class="fas fa-map-marker-alt icon icon-green"></i><b>Store Location</b></h2>
            <p><b>Uptown, Jalan Desa Ilmu, 94300 Kota Samarahan, Sarawak.</b></p>
            <h2><i class="fas fa-envelope icon icon-red"></i><b>Email Address</b></h2>
            <p><b>info@cooliesbakery.com</b></p>
            <h2><i class="fas fa-phone icon icon-green"></i><b>Phone Number</b></h2>
            <p><b>(+60) 3144-8076</b></p>
        </div>
        <div class="contact_us">
            <h1><b>Send an enquiry</b></h1>
            <hr><br>
            <form method="post" action="contactus.php" onsubmit="return validate()">
                <table>
                    <br></br>
                    <tr>
                        <td class="label"><label for="email"><b>Email:</b></label></td>
                        <td><input type="email" name="email" id="email" required></td>
                    </tr>
                    <tr>
                        <td class="label"><label for="name"><b>Name:</b></label></td>
                        <td><input type="text" name="name" id="name" required></td>
                    </tr>
                    <tr>
                        <td class="label"><label for="phonenum"><b>Phone Number:</b></label></td>
                        <td>
                            <input type="text" name="phonenum" id="phonenum" required>
                            <span id="phonenum_error" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"><label for="message"><b>Message:</b></label></td>
                        <td><textarea name="message" id="message" required></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right"><input type="submit" value="Submit"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <footer class="footer">
        <div class="container text-center"><span class="text-muted"><b>Copyright &copy; Coolie's Bakery | All Rights Reserved</b></span></div>
    </footer>
    <script>
        function validate() {
            var phoneNumber = document.getElementById("phonenum").value;
            var numbersOnly = /^[0-9]+$/;

            if (!phoneNumber.match(numbersOnly)) {
                document.getElementById("phonenum_error").innerHTML = "Please enter a valid phone number.";
                return false;
            }

            return true;
        }
    </script>
</body>

</html>