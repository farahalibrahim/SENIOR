<?php

include_once('../connection.inc.php');
include_once('../dbh.class.inc.php');
$conn = DatabaseHelper::connect([DBCONNSTRING, DBUSER, DBPASS]);

// $barcode = '300880128754';
// $supermarket_id = '2'; // for testing purposes

$barcode = $_GET['barcode'];
// // echo $barcode;
// $supermarket_id = $_GET['supermarket'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- header and footer's css -->
    <link rel="stylesheet" href="../../CSS/header_footer.css">
    <link rel="stylesheet" href="../../CSS/viewproduct.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- import AJAX jquery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--link to google symbols-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- <script src="../../JS/responseModal.js"></script> -->
    <?php include_once '../responseModal.inc.php'; ?>
    <style>
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            /* background-color: rgb(0, 0, 0); */
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>

<body>

    <!-- <br><br><br><br><br><br><br><br> -->
    <!-- header -->
    <?php include_once '../header.php';
    ?>
    <div class="product_container">
        <?php

        // product with same barcode accross all supermarkets selling it, inner join to include sypermarket name too
        $sql = "SELECT product.*, supermarket.name as supermarket_name, supermarket.rating as supermarket_rating
        FROM product 
        INNER JOIN supermarket ON product.supermarket_id = supermarket.id 
        WHERE product.barcode = :barcode
        ORDER BY product.price ASC";

        $stmt = DatabaseHelper::runQuery($conn, $sql, ['barcode' => $barcode]);

        // Flag variable to track whether the first row has been processed
        // use to grab product_image only once for all products
        $firstRow = true;

        echo '<div class="flex-container">';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($firstRow) {
                // Display the image for the first product
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mimeType = $finfo->buffer($row['product_image']);

                $imageData = base64_encode($row['product_image']);
                $src = 'data:' . $mimeType . ';base64,' . $imageData;

                echo '<div class="product_image"><img src="' . $src . '" alt="' . $row['product_name'] . '"></div>';
                echo '<div class="product_details">';
                echo '<p>' . $row['manufacturer'] . '</p>';
                echo '<h2>' . $row['product_name'] . '</h2>';
                $quantity = $row['quantity'];
                $quantity_type = $row['quantity_type'];
                $unit = '';

                if ($quantity >= 1000) {
                    $quantity /= 1000;
                    $unit = ($quantity_type == 'weight') ? 'kg' : (($quantity_type == 'liquid') ? 'L' : 'pieces');
                } else {
                    $unit = ($quantity_type == 'weight') ? 'g' : (($quantity_type == 'liquid') ? 'ml' : 'pieces');
                }
                echo "<p>{$quantity} {$unit}</p>";


                if ($row['manufacturer'] == 'local') {
                    echo '<p>This product is locally manufactured, ensuring fresh and high-quality ingredients. Support local businesses and enjoy the taste of homegrown goodness.</p>';
                }


                $nutritional_categories = ['Bakery', 'Beverages', 'Dairy', 'Fruits & Vegetables', 'Meat & Chicken', 'Snacks'];

                if (in_array($row['category'], $nutritional_categories) && !is_null($row['nutritional_facts'])) {
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $mimeType = $finfo->buffer($row['nutritional_facts']);

                    $src = 'data:' . $mimeType . ';base64,' . $row['nutritional_facts'];
                    echo '<details>';
                    echo '<summary>Details</summary>';
                    echo '<img id="nutrition" src="' . $src . '" alt="Nutritional Facts">';
                    echo '</details>';
                }
                echo '<table class= "comparison_table" style="border: 2px solid black;">';
                $firstRow = false;
            }

            // Display the product details in a table
            echo '<tr>';
            if ($row['offer'] == 1) {
                $offerClass = ' class="offer-row"'; // indicate if the product is on offer
            } else {
                $offerClass = '';
            }
            echo '<td' . $offerClass . '><div class="supermarket_rating"><p class="supermarket_name">' . $row['supermarket_name'] . '</p>';
            if ($row['supermarket_rating'] !== null) {
                echo ' <div class="rating">';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= ceil($row['supermarket_rating'])) {
                        echo '<span class="star" style="color: yellow;">&#9733;</span>'; // Full star
                    } else {
                        echo '<span class="star" style="color: gray;">&#9734;</span>'; // Empty star
                    }
                }
                if ($row['supermarket_rating'] - floor($row['supermarket_rating']) > 0) { // display the rating if it is decimal
                    echo ' (' . $row['supermarket_rating'] . ')';
                }
                echo '</div>';
            }
            echo '</div></td>';

            echo '<td' . $offerClass . '>$' . $row['price'] . '</td>';

            echo '<td' . $offerClass . '><button class="add_to_list" data-barcode="' . $row['barcode'] . '" data-supermarket-id="' . $row['supermarket_id'] . '"><span class="material-symbols-outlined">playlist_add</span></button></td>';
            // add to cart button always exists yet if logged in it adds to cart if not a popup prompts to log in/sign up(in ajax file addtocart.js)
            echo '<td' . $offerClass . '><button class="add_to_cart" data-barcode="' . $row['barcode'] . '" data-supermarket-id="' . $row['supermarket_id'] . '">
            <span class="material-symbols-outlined">add_shopping_cart</span>
            </button></td>';
            echo '</tr>';
        }

        echo '</table></div></div>';

        ?>

    </div>

    <!-- frequently bought together section -->
    <div class="frequently-container">

        <?php
        // get product tag to find matching products
        $sql = "SELECT DISTINCT tag FROM product WHERE barcode = :barcode";
        $stmt = DatabaseHelper::runQuery($conn, $sql, ['barcode' => $barcode]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $tag = $row['tag'];

        // get barcode's product_name
        $sql = "SELECT DISTINCT product_name FROM product WHERE barcode = :barcode";
        $stmt = DatabaseHelper::runQuery($conn, $sql, ['barcode' => $barcode]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $product = $row['product_name'];

        // retrieve max 5 products of the same tag, excluding the product itself (barcode: for same specifications, 
        // product_name: for same product different specifications(weight...)
        $sql = "SELECT barcode, product_name, product_image, MIN(price) as min_price, MAX(price) as max_price 
        FROM product 
        WHERE tag = :tag AND barcode != :barcode AND product_name != :product_name
        GROUP BY product_name 
        LIMIT 5;";

        $stmt = DatabaseHelper::runQuery($conn, $sql, ['tag' => $tag, 'barcode' => $barcode, 'product_name' => $product]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            // one related product atleast exist
            echo '<h2>Frequently Bought Together</h2>';
        }

        foreach ($results as $result) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($result['product_image']);

            $imageData = base64_encode($result['product_image']);
            $src = 'data:' . $mimeType . ';base64,' . $imageData;

            echo '<a href="viewproduct.php?barcode=' . $result['barcode'] . '"><div class="frequentcard">';
            echo '<img src="' . $src . '" alt="' . $result['product_name'] . '">'; // use $src here
            echo '<h2 class="product_name">' . $result['product_name'] . '</h2>';
            echo '<div class="product_details"><p> $' . $result['min_price'] . ' - $' . $result['max_price'] . '</p></div></a>';
            echo '<a class="prodarrow" href="viewproduct.php?barcode=' . $result['barcode'] . '"><span class="material-symbols-outlined" id="catarrow">arrow_forward</span></a>';
            echo '</div>';
        }


        ?>
    </div>
    </div>
    <div id="responseModal" class="modal">
        <div class="modal-content">
            <!-- <span class="close">&times;</span> -->
            <p id="responseText"></p>
        </div>
    </div>

    <script src="../../JS/addtocart.js"></script>

    <input type="hidden" class="click_product" data-barcode="<?= $barcode ?>">
    <script src="../../JS/track_click.js"></script>
    <script>
        $(document).ready(function() {
            $('.click_product').trigger('click');
        });
    </script>

    <!--Footer Section-->
    <?php include_once '../footer.php'; ?>
</body>

</html>