<?php
include_once('includes/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_id = strtolower(str_replace(" ", "-", $product_name));

    // File upload handling
    $targetDir = "product_images/";
    $fileName = basename($_FILES["product_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $imageFileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if the uploaded file is an image
    $validExtensions = array("jpg", "jpeg", "png");
    if (in_array(strtolower($imageFileType), $validExtensions)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {
            // Set the product image URL
            $product_image = $targetDir . $fileName;

            // Insert the product into the database
            $sql = "INSERT INTO `products` (
                    `product_id`,
                    `product_url`,
                    `product_name`,
                    `product_description`,
                    `product_price`,
                    `product_image_1`,
                    `product_image_2`,
                    `product_image_3`
                )
                VALUES (
                    NULL,
                    '$product_id',
                    '$product_name',
                    '$product_description',
                    '$product_price',
                    '$product_image',
                    '$product_image',
                    '$product_image'
                )";
            $stmtProduct = $db_conn->prepare($sql);
            $stmtProduct->execute();

            echo "Product added successfully!";
            header("Location: products.php");
            die();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Invalid file format. Only JPG, JPEG, and PNG images are allowed.";
    }
}
?>

<head>
    <title>Sneakerz | Add Product</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/products.css" />
</head>
<body>
    <div class="container-add-product">
        <h1>Add A Sneaker</h1>
        <form action="add-product.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Sneaker Name</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>

            <div class="form-group">
                <label for="product_price">Sneaker Price</label>
                <input type="text" id="product_price" name="product_price" required>
            </div>

            <div class="form-group">
                <label for="product_description">Sneaker Description</label>
                <textarea id="product_description" name="product_description" required></textarea>
            </div>

            <div class="form-group">
                <label class="file-input-label" for="product_image">
                    <input type="file" id="product_image" name="product_image" accept="image/*" onchange="updateFileName(this)">
                    <span class="file-input-text">Choose A Sneaker Image</span>
                </label>
                <span id="file-name"></span>
            </div>

            <input type="submit" name="submit" value="Add Product" class="submit-button">
        </form>
    </div>

    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var fileNameElement = document.getElementById("file-name");
            fileNameElement.textContent = fileName;
        }
    </script>

<?php
include_once('includes/footer.php');
?>