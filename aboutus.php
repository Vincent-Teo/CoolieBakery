<?php
session_start();
?>
<html>

<head>
    <title>Coolie's Bakery-About Us</title>
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
        #aboutus {
            background-color: #F5DEB3;
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
        }

        .container-aboutus {
            display: flex;
            padding-top: 50px;
            padding-bottom: 150px;
        }

        .content-aboutus {
            width: 50%;
            padding: 20px;
        }

        .image-aboutus {
            flex: 1;
            text-align: center;
        }

        .image-aboutus img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #ab1,
        #ab2 {
            color: black;
            font-size: 150%;
        }

        #ab3 {
            margin-bottom: 10px;
            font-size: 100%;
        }
    </style>
</head>

<body id="aboutus">
    <!--Header-->
    <?php
    include 'includes/header_menu.php';
    ?>
    <!--Header ends-->
    <div class="container-aboutus">
        <div class="image-aboutus">
            <img src="images/aboutus.jpg" alt="Bakery Image">
        </div>
        <div class="content-aboutus">
            <h1 id="ab1">About Us</h1>
            <p id="ab3">Welcome to The Coolie's Bakery, your ultimate destination for homemade baked goods!</p>
            <p id="ab3">At The Coolie's Bakery, we take pride in offering a wide variety of delicious homemade bread, cakes, cookies, and more. Our products are freshly baked on the day they are made, ensuring the highest quality, freshness, and taste.</p>
            <p id="ab3">Our mission is to share our love for baking with everyone and provide a convenient way for our customers to enjoy our mouthwatering treats. With our online ordering system, you can now order your favorite baked goods from the comfort of your own home or wherever you may be.</p>
            <h2 id="ab2">Convenience and Quality</h2>
            <p id="ab3">We understand the value of your time, which is why we have developed a user-friendly web application that allows you to easily browse through our products, add them to your cart, and complete your order with just a few clicks. No more standing in queues or rushing to the bakery!</p>
            <p id="ab3">Quality is our top priority. We use only the finest ingredients and follow traditional recipes to create homemade flavors that will leave you craving for more. Each bite is a testament to our commitment to delivering the best bakery experience.</p>
            <h2 id="ab2">Mission</h2>
            <p id="ab3">Our mission at The Coolie's Bakery is to create exceptional homemade baked goods that bring joy and satisfaction to our customers. We are dedicated to using the finest ingredients, traditional recipes, and careful craftsmanship to deliver a delightful bakery experience.</p>
            <h2 id="ab2">Vision</h2>
            <p id="ab3">Our vision is to be the preferred choice for homemade baked goods, known for our commitment to quality, freshness, and convenience. We aim to create lasting memories with every bite and to become a beloved bakery that customers can rely on for their favorite treats.</p>
        </div>
    </div>
    <!--footer -->
    <?php include 'includes/footer.php' ?>
    <!--footer end-->
</body>

</html>