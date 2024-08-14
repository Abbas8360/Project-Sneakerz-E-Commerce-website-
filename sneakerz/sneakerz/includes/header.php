<?php
session_start();

include_once('includes/config.php');

#Auth Section
if (isset($_SESSION['email']) && isset($_SESSION['token'])) {

    #Store retrieved session values
    $email = $_SESSION['email'];
    $token = $_SESSION['token'];

    # if email and token is set check them against the database, retrieve and store the email and token retrieved for comparison

    $sql = "SELECT user_email, user_token from users WHERE user_email = '$email'";
    $retrieveStmt = $db_conn -> prepare($sql);
    $retrieveStmt -> execute();

    $user_row = $retrieveStmt -> fetch(PDO::FETCH_ASSOC);

    if ($user_row > 0) {
        # store values to be compared
        $_server_email = $user_row['user_email'];
        $_server_token = $user_row['user_token'];
    }

}

$totalCartProducts = 0;

# Get the total number of products in user cart
if (isset($_SESSION['email'])) {
    $arr = explode("@", $_SESSION['email'], 2); 
    $cartName = $arr[0] . '_cart';

    $allUserCartProductss = $db_conn -> prepare("SELECT * FROM $cartName");
    $allUserCartProductss -> execute();

    $totalCartProducts = $allUserCartProductss -> rowCount();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="images/icons/favicon.png" sizes="128x128" />

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />

    <!-- Anonymous Pro Font CDN -->
    <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro" rel="stylesheet">

    <!-- Roboto font CDN -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

</head>
<body>
    <div class="side-menu">
        <ul>
            <li>
                <a href="index.php" class="active-link">
                    Home
                </a>
            </li>
            <li>
                <a href="products.php">
                    Shop
                </a>
            </li>
            <li>
                <a href="cart.php">
                    Cart
                </a>
            </li>
            <li>
                <a href="team.php">
                    Team
                </a>
            </li>
            <li>
                <a href="contact.php">
                    Contact
                </a>
            </li>
            <li>
                <a href="add-product.php">
                    Add Sneaker
                </a>
            </li>
            <li>
                <a href="remove-product.php">
                    Remove Sneaker
                </a>
            </li> 
        </ul>
        <a href="about-us.php" class="disclaimer">About Us</a>
        <a href="privacy-policy.php" class="disclaimer">Privacy Policy</a>
        <p hred="#" class="disclaimer">Copyright © 2023 NSU IET Department</p>
    </div>

    <div class="clearfix"></div>

    <div class="overlay">

    </div>

    <div class="clearfix"></div>

    <div class="login-wrapper">
        <h3>Login</h3>
        <form  id="login-form">
            <input type="email" id="login-email" name="login-email" placeholder="Email Address" required/>
            <input type="password" id="login-password" name="login-password" placeholder="Password" required/>
            <p></p>
            <input id="login-btn" type="submit" value="Log in" />
        </form>
    </div>

    <div class="signup-wrapper">
        <h3>Sign up</h3>
        <form id="signup-form">
            <input type="text" id="signup-name" placeholder="Name*" required/>
            <input type="email" id="signup-email" placeholder="Email Address*" required/>
            <input type="password" id="signup-password" placeholder="Password*" required/>
            <input type="text" id="signup-address" placeholder="Address*" required/>
            <p></p>
            <input id="signup-btn" type="submit" value="Sign up" />
        </form>
    </div>

    <div class="container">
        <nav>
            <div class="menu-container">
                <div class="menu-icon">
                    <span class="menu-aria"></span>
                    <span class="menu-aria"></span>
                    <span class="menu-aria"></span>
                    <div class="menu-text">
                        <p>Sneakerz</p>
                    </div>
                </div>
                <div class="menu-login-signup">
                    <?php
                    if (isset($_SESSION['email']) && isset($_SESSION['token'])) {
                        if ($email == $_server_email && $token == $_server_token)
                        {
                            echo '<a href="includes/logout.php" class="user-logout">Logout</a>';
                        }
                    } else {
                        echo '<a href="#" class="login">Login</a>
                        <a href="#" class="signup">Signup</a>';
                    }
                    ?>
                </div>
                <div class="menu-cart">
                    <div class="cart-count">
                        <p>
                            <?php echo $totalCartProducts; ?>
                        </p>
                    </div>
                    <p>
                        <?php
                            if (isset($_SESSION['email']) && isset($_SESSION['token'])) {
                                echo '<a href="cart.php">Cart</a>';
                            } else {
                                echo 'Cart';
                            }
                        ?>
                    </p>
                </div>
            </div>
        </nav>