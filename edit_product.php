<?php
session_start();

require_once 'includes/common.php';

if (!isset($_GET['id'])) {
    header("Location: adminproduct.php");
    exit();
}

$productId = $_GET['id'];

$productQuery = "SELECT name, price FROM products WHERE id = '$productId'";
$productResult = mysqli_query($con, $productQuery);
$productData = mysqli_fetch_assoc($productResult);

// Handle form submission for updating product details
if (isset($_POST['submit'])) {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    $updateQuery = "UPDATE products SET name = '$productName', price = '$productPrice' WHERE id = '$productId'";
    mysqli_query($con, $updateQuery);
    header("Location: adminproduct.php");
    exit();
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'admin_navbar.php'; ?>
    <div class="container">
        <h1>Edit Product</h1>
        <form method="post">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $productData['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="<?php echo $productData['price']; ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>