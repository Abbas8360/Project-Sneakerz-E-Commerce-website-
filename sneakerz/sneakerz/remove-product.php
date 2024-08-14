<?php
include_once('includes/header.php');

// Retrieve all products from the database
$sql = "SELECT * FROM `products`";
$stmtProducts = $db_conn->prepare($sql);
$stmtProducts->execute();
$products = $stmtProducts->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];

    // Check if the selected product exists in the database
    $sql = "SELECT * FROM `products` WHERE `product_id` = :product_id";
    $stmtProduct = $db_conn->prepare($sql);
    $stmtProduct->bindParam(':product_id', $product_id);
    $stmtProduct->execute();

    if ($stmtProduct->rowCount() > 0) {
        // Delete the product from the database
        $sql = "DELETE FROM `products` WHERE `product_id` = :product_id";
        $stmtDelete = $db_conn->prepare($sql);
        $stmtDelete->bindParam(':product_id', $product_id);
        $stmtDelete->execute();

        echo "Sneaker removed successfully!";
        header("Location: products.php");
    } else {
        echo "Sneaker not found.";
    }
}
?>

<head>
    <title>Sneakerz | Remove Product</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/products.css" />
</head>
<body>
    <div class="container-remove-product">
        <h1>Remove A Sneaker</h1>
        <form action="remove-product.php" method="post">
            <div class="form-group" style="text-align: center;">
                <label for="product_id">Select a Sneaker</label>
                <div class="custom-dropdown">
                    <select id="product_id" name="product_id" required>
                        <option value="">Select a Sneaker</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?php echo $product['product_id']; ?>"><?php echo $product['product_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <input type="submit" name="submit" value="Remove Sneaker" class="submit-button">
        </form>
    </div>

    <?php
include_once('includes/footer.php');
?>