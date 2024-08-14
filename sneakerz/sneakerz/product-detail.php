<?php
include_once('includes/header.php');

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$product_name_url = substr($url, strpos($url, '?') + 1);

if (!empty($product_name_url)) {
    
    $getProduct = $db_conn -> prepare("SELECT * FROM products WHERE product_url = '$product_name_url'");
    $getProduct -> execute();
    $product = $getProduct -> fetch(PDO::FETCH_ASSOC);

    $product_id_next = $product['product_id'] + 1;
    $product_id_prev = $product['product_id'] - 1;

    $nextProduct = $db_conn -> prepare("SELECT product_url FROM products WHERE product_id = '$product_id_next'");
    $nextProduct -> execute();
    $next_product = $nextProduct -> fetch();

    $prevProduct = $db_conn -> prepare("SELECT product_url FROM products WHERE product_id = '$product_id_prev'");
    $prevProduct -> execute();
    $prev_product = $prevProduct -> fetch();

    $rows = $getProduct -> rowCount();
    if ($rows > 0) {
        # Product exists
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}


if (isset($_SESSION['email'])) {
    $productInCartID = $product['product_id'];
    $checkCart = $db_conn -> prepare("SELECT * FROM $cartName WHERE product_id = $productInCartID");

    $checkCart -> execute();
    $checkCartProduct = $checkCart -> fetch(PDO::FETCH_ASSOC);
}


?>

<head>
    <title>Sneakerz | Product Detail</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/products.css" />
    <!-- Product Detail CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/product-detail.css" />
</head>
<body>
        <div class="product-container">
            <div class="carousel">
                <div class="product-image item">
                    <img src="<?php echo $product['product_image_1']; ?>" alt="Product 1" />
                </div>
            </div>

            <div class="product-title">
                <h4><?php echo $product['product_name']; ?></h4>
                <p>$<?php echo $product['product_price']; ?></p>
            </div>

            <div class="product-description">
                <div class="product-description-wrapper">
                    <p><?php echo $product['product_description']; ?></p>
                    <?php
                    if (isset($_SESSION['email']) && isset($_SESSION['token'])) {
                        if ($email == $_server_email && $token == $_server_token && $checkCartProduct > 0)
                        {
                            // Show remove from cart button
                            echo '
                            <a class="add-to-cart added"><span></span></a>
                            ';
                        } else {

                            // Show add to cart button 
                            echo '
                            <a class="add-to-cart"><span></span></a>
                            ';
                        }          
                    } else {
                        // Show add to cart button which redirects to login
                        echo '<button class="product-detail-add-to-cart"><span>+</span>Add to cart</button>';
                    }
                    ?>
                </div>
            </div>

            <div class="product-switch">
                <?php
                    if ($prev_product > 0) {
                        echo '<a href="product-detail.php?' . $prev_product['product_url'] . '">
                        <img class="previous-button" src="images/icons/icon_previous.png" alt="Previous Product">
                        </a>';
                    }

                    if ($next_product > 0) {
                        echo '<a href="product-detail.php?' . $next_product['product_url'] . '">
                        <img class="next-button" src="images/icons/icon_next.png" alt="Next Product">
                        </a>';
                    }
                ?>
                
            </div>

            <div class="clearfix"></div>

        </div>
    </div>

<?php
include_once('includes/footer.php');
?>