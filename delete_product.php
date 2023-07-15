<?php
require_once 'includes/common.php';

$productId = $_GET['id'];


$deleteProductQuery = "DELETE FROM products WHERE id = '$productId'";
mysqli_query($con, $deleteProductQuery);

mysqli_close($con);

header("Location: adminproduct.php");
exit();
?>

<!DOCTYPE html>
<html>

<head>
    <script>
        function confirmDelete() {
            var result = confirm("Are you sure you want to delete this product?");
            if (result) {
                window.location = "delete_product.php?id=<?php echo $productId; ?>";
            } else {

                window.location = "adminproduct.php";
            }
        }
    </script>
</head>

<body>
    <h1>Delete Product</h1>
    <button onclick="confirmDelete()">Delete</button>
</body>

</html>