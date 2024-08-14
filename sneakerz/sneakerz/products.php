<?php
include_once('includes/header.php');

$getProducts = $db_conn->prepare("SELECT * FROM products");
$getProducts->execute();

$products = $getProducts->fetchAll();
?>

<head>
    <title>Sneakerz | Products</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/products.css" />
</head>
<body>
    <div class="search-container">
        <input type="text" id="searchInput" class="search-input" placeholder="Search Sneaker" />
    </div>

    <div class="products-container">
        <?php
        $rows = $getProducts->rowCount();
        if ($rows > 0) {
            for ($i = 0; $i < $rows; $i++) {
                echo '
                <a href="product-detail.php?' . $products[$i]['product_url'] . '" class="product-card">
                    <img src="' . $products[$i]['product_image_1'] . '" alt="' . $products[$i]['product_name'] . '" />
                    <div class="product-title">
                        <h4>' . $products[$i]['product_name'] . '</h4>
                        <p>$' . $products[$i]['product_price'] . '</p>
                    </div>
                </a>';
            }
        }
        ?>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const productCards = document.querySelectorAll('.product-card');

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();

            productCards.forEach(function (card) {
                const title = card.querySelector('h4').textContent.toLowerCase();
                const price = card.querySelector('p').textContent.toLowerCase();

                if (title.includes(searchTerm) || price.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>

<?php
include_once('includes/footer.php');
?>