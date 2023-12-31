<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coolie's Bakery - Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!--header -->
    <?php
    include 'includes/header_menu.php';
    ?>
    <!--header ends -->
    <div class="container" style="margin-top: 65px">
        <!--jumbutron start-->
        <div class="jumbotron text-center">
            <h3>Welcome to Coolie's Bakery</h3>
            <p>We provide ease for our customers to buy fresh baked goods</p>
        </div>
        <!--jumbutron ends-->
        <hr />
        <!--search bar-->
        <div class="row mb-4">
            <div class="col-md-6 offset-md-3">
                <form action="search.php" method="GET" class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search by product name">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <!--search bar ends-->
        <!--menu list-->
        <div class="row text-center">
            <?php
            require_once 'includes/common.php';

            // Check if a search query is present
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                // Query to search for products based on name
                $query = "SELECT * FROM products WHERE name LIKE '%$search%'";
                $result = mysqli_query($con, $query);
            } else {
                // No search query, show all products
                $query = "SELECT * FROM products";
                $result = mysqli_query($con, $query);
            }

            if (mysqli_num_rows($result) > 0) {//loop and display all products
                while ($row = mysqli_fetch_assoc($result)) {
                    $productId = $row['id'];
                    $productName = $row['name'];
                    $productPrice = $row['price'];
                    $description = $row['description'];
                    $portion = $row['portion'];
                    $productImage = $row['image'];
            ?>
                    <div class="col-md-3 col-6 py-3">
                        <div class="card">
                            <?php if ($productImage) { ?>
                                <img src="images/<?php echo $productImage; ?>" alt="" class="img-fluid pb-1">
                            <?php } else { ?>
                                <img src="images/placeholder-image.jpg" alt="No Image Available" class="img-fluid pb-1">
                            <?php } ?>
                            <div class="figure-caption">
                                <h6><u><?php echo $productName; ?></u></h6>
                                <h6>Price:</h6>
                                <h6>RM <?php echo $productPrice; ?></h6>
                                <h6>Portion: <?php echo $portion; ?></h6>
                                <h6>Description:</h6>
                                <h6><?php echo $description; ?></h6>
                                <form method="POST" action="cart-add.php">
                                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                    <div class="form-group">
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                                    </div>
                                    <?php if (!isset($_SESSION['email'])) { ?>
                                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white">Add To Cart</a></p>
                                    <?php } else { ?>
                                        <button type="submit" name="add_to_cart" class="btn btn-warning text-white">Add to cart</button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "<p>No products found.</p>";
            }

            mysqli_close($con);
            ?>
        </div>
    </div>
    <!--menu list ends-->
    <!-- footer-->
    <?php include 'includes/footer.php' ?>
    <!--footer ends-->
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
    $(document).ready(function() {

        if (window.location.href.indexOf('#login') != -1) {
            $('#login').modal('show');
        }

    });
</script>
<?php if (isset($_GET['error'])) {
    $z = $_GET['error'];
    echo "<script type='text/javascript'>
        $(document).ready(function(){
            $('#signup').modal('show');
        });
        </script>";
    echo "<script type='text/javascript'>alert('" . $z . "')</script>";
} ?>

<?php if (isset($_GET['errorl'])) {
    $z = $_GET['errorl'];
    echo "<script type='text/javascript'>
        $(document).ready(function(){
            $('#login').modal('show');
        });
        </script>";
    echo "<script type='text/javascript'>alert('" . $z . "')</script>";
} ?>

</html>
