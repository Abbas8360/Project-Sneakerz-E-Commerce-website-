<?php
include_once('includes/header.php');
?>

<head>
    <title>Sneakerz | Shipping</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/products.css" />
</head>
<body>
        <div class="products-container">
            <div class="address-wrapper">
                <h2>Shipping Address</h2>
                <p class="status">Fill City</p>
                <form id="address-form" action="includes/functions.php" method="POST">
                    <input type="text" placeholder="Address" name="address" required>
                    <input type="text" placeholder="City" name="city" class="address_half_input margin-right" required>
                    <input type="text" placeholder="State" name="state" class="address_half_input" required>
                    <input type="text" placeholder="Landmark" name="landmark" class="address_half_input margin-right" required>
                    <input type="text" placeholder="Pincode" name="pincode" class="address_half_input" required>
                    <input type="submit" value="Complete Order">
                </form>
            </div>
        </div>
    </div>

<?php
include_once('includes/footer.php');
?>