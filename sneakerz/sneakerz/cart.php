<?php 

include_once('includes/header.php');

if (isset($_SESSION['email']) && isset($_SESSION['token'])) {
    if ($email == $_server_email && $token == $_server_token)
    {
        $arr = explode("@", $_SESSION['email'], 2); 
        $cartName = $arr[0] . '_cart';

        $getCartProducts = $db_conn -> prepare("SELECT * FROM $cartName");
        $getCartProducts -> execute();

        $cartProducts = $getCartProducts -> fetchAll();
    }
} else {
    echo "<script>alert('You need to login to view cart!');window.location.href='index.php'</script>";
}

if (isset($_SESSION['email'])) {
    #Total Quantity of products
    $stmtTotalProductQuantity = $db_conn -> prepare("SELECT SUM(product_quantity) FROM $cartName");
    $stmtTotalProductQuantity -> execute();

    $stmtTotalProductQuantityRow = $stmtTotalProductQuantity -> fetch(PDO::FETCH_NUM);

    $totalProducts = $stmtTotalProductQuantityRow[0];

    #Total Price of Products
    $totalPriceProducts = $db_conn -> prepare("SELECT SUM(product_total) FROM $cartName");

    $totalPriceProducts -> execute();

    $totalPriceRow = $totalPriceProducts -> fetch(PDO::FETCH_NUM);

    $totalPrice = $totalPriceRow[0];


    # Get all products added to cart
    $allCartProducts = $db_conn -> prepare("SELECT * FROM $cartName");
    $allCartProducts -> execute();

    $allCartProductsRow = $allCartProducts -> fetchAll();
}


?>

<head>
    <title>Sneakerz | Cart</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/products.css" />
</head>
<body>
        <div class="products-container">
            <div class="cart-wrapper">
                <h2>Cart <?php echo '(' . $totalCartProducts . ')'; ?></h2>
                <div class="cart-products">
                    <?php
                        $cartProductsCount = $allCartProducts -> rowCount();

                        for ($i=0; $i < $cartProductsCount; $i++) { 
                            $cartProductQuantitySelected = '';

                            for ($j=1; $j <= 4; $j++) { 
                                # Loop through all the quantity of the cart product
                                if ($allCartProductsRow[$i]['product_quantity'] == $j) {
                                    # Print normal select option
                                    $cartProductQuantitySelected .= '
                                    <option selected="selected" value="' . $j . '">' . $j . '</option>
                                    ';
                                } else {
                                    # Print normal select option
                                    $cartProductQuantitySelected .= '
                                    <option value="' . $j . '">' . $j . '</option>
                                    ';
                                }
                            }

                            # Display the products
                            echo '
                            <div class="product">
                                <div class="product-image-wrapper">
                                    <img src="' . $allCartProductsRow[$i]['product_image'] . '" alt="' . $allCartProductsRow[$i]['product_name'] . '">
                                </div>
                                <div class="product-content-wrapper">
                                    <div class="content">
                                        <h4>' . $allCartProductsRow[$i]['product_name'] . '</h4>
                                        <p>$' . $allCartProductsRow[$i]['product_price'] . '</p>
                                        <select name="' . $allCartProductsRow[$i]['product_name'] . '" class="number_of_products">
                                        ' . $cartProductQuantitySelected . '
                                        </select>
                                        <img src="images/icons/icon_close.png" alt="' . $allCartProductsRow[$i]['product_name'] . '" class="remove_product">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            ';
                        }
                    ?>
                </div>
            </div>
            <div class="checkout-wrapper">
                <p>Total Items: <span><?php echo $totalProducts; ?></span></p>
                <p>Products Price: 
                    <span>
                        <?php 
                            $totalPrice = number_format((float)$totalPrice, 2, '.', '');
                            echo '$'.$totalPrice;
                        ?>
                    </span>
                </p>
                <p>GST (18%): 
                    <span>
                    <?php 
                        $gst = $totalPrice * 18 / 100;
                        $gst = number_format((float)$gst, 2, '.', '');
                        echo '$'.$gst; 
                    ?>
                    </span>
                </p>
                <p>Rounded Price: 
                    <span>
                    <?php 
                        $priceDiff = $totalPrice + $gst - round($totalPrice + $gst);

                        $priceDiff = number_format((float)$priceDiff, 2, '.', '');
                        echo '$'.$priceDiff; 
                    ?>
                    </span>
                </p>
                <div class="spacer"></div>
                <p>Total Price: </p>
                <p class="total-price">
                    <span>
                        <?php 
                            $totalPriceAfterGST = $totalPrice + $gst - $priceDiff;

                            $totalPriceAfterGST = number_format((float)$totalPriceAfterGST, 2, '.', '');
                            echo '<sup>$ </sup>'.$totalPriceAfterGST; 
                        ?>
                    </span>
                </p>
                <?php
                    if ($totalCartProducts > 0) {
                        # Show Checkout button only if user cart has product
                        echo '
                            <a href="shipping.php" class="checkout-button">         Checkout
                            </a>
                        ';
                    }
                ?>
            </div>
        </div>
    </div>

<?php
include_once('includes/footer.php');
?>