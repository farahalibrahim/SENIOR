<?php
include_once('../PHP/connection.inc.php');
include_once('../PHP/dbh.class.inc.php');
$conn = DatabaseHelper::connect([DBCONNSTRING, DBUSER, DBPASS]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/test.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!--link to box icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!--link to google symbols-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header class="header">
        <a href="#" class="logo"><span class="material-symbols-outlined">
                shopping_cart
            </span> Shop Smart</a>
        <div><span class="material-symbols-outlined" id="menuicon">
                menu
            </span></div>
        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#categories">Categories</a>
            <a href="#products">Products</a>
            <a href="#about">About</a>

        </nav>
        <!-- <div class="profile">
            <img src="../pics/pngwing.com.png" alt="">
            <span>Profile</span>
            <span class="material-symbols-outlined">
                arrow_drop_down
                </span>
        </div>-->
        <div class="profile">
            <a href="../HTML/login.html" target="_blank">Login</a>
        </div>
    </header>
    <!--Home Page-->
    <section class="home" id="home">
        <div class="swiper-wrapper">
            <div class="swiper-slide container ">
                <div class="home-text">
                    <span>Shop Smart</span>
                    <h1>Choose Your <br>best Offer <br>NOW !!!</h1>
                    <a href="#" class="btn">Shop Now <span class="material-symbols-outlined" id="R-arrow">
                            arrow_forward
                        </span></a>
                </div>
                <img src="../pics/Best Offer 3D Text.G03.watermarked.2k.png" alt="">
            </div>

            <!--Slide 2-->
            <div class="swiper-slide container">
                <div class="home-text">
                    <span>Shop Smart</span>
                    <h1>Compare between <br>Many Offers <br> --><-- </h1>
                            <a href="#" class="btn">Shop Now <span class="material-symbols-outlined" id="R-arrow">
                                    arrow_forward
                                </span></a>
                </div>
                <img src="../pics/Compare Symbol.G03.watermarked.2k.png" alt="">
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!--Categories Section-->
    <section class="categories" id="categories">
        <div class="heading">
            <h1>Browse Our <br><span>Categories</span></h1>
            <a href="#" class="btn">See All <span class="material-symbols-outlined" id="R-arrow">
                    arrow_forward
                </span></a>
        </div>
        <!--Categories Container-->
        <div class="categories-container">
            <!--Box 1-->
            <div class="box box1">
                <img src="../pics/Fruits & Vegetables.png" alt="">
                <h2>Fruits & Vegetables</h2>
                <span><?php
                        $sql = "SELECT COUNT(*) FROM product WHERE category = 'Fruits & Vegetables'";
                        $stmt = DatabaseHelper::runQuery($conn, $sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $result['COUNT(*)'];

                        ?> Items</span>
                <a href="../PHP/products.php?category=Fruits_Vegetables"><span class="material-symbols-outlined" id="catarrow">
                        arrow_forward
                    </span></a>
            </div>

            <!--Box 2-->
            <div class="box box1">
                <img src="../pics/Bakery.png" alt="">
                <h2>Bakery</h2>
                <span><?php
                        $sql = "SELECT COUNT(*) FROM product WHERE category = 'Bakery'";
                        $stmt = DatabaseHelper::runQuery($conn, $sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $result['COUNT(*)'];

                        ?> Items</span>
                <a href="../PHP/products.php?category=Bakery"><span class="material-symbols-outlined" id="catarrow">
                        arrow_forward
                    </span></a>
            </div>

            <!--Box 3-->
            <div class="box box1">
                <img src="../pics/Dairy.png" alt="">
                <h2>Dairy</h2>
                <span><?php
                        $sql = "SELECT COUNT(*) FROM product WHERE category = 'Dairy'";
                        $stmt = DatabaseHelper::runQuery($conn, $sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $result['COUNT(*)'];

                        ?> Items</span>
                <a href="../PHP/products.php?category=Dairy"><span class="material-symbols-outlined" id="catarrow">
                        arrow_forward
                    </span></a>
            </div>

            <!--Box 4-->
            <div class="box box1">
                <img src="../pics/Meat & Chicken.png" alt="">
                <h2>Meat & Chicken</h2>
                <span><?php
                        $sql = "SELECT COUNT(*) FROM product WHERE category = 'Meat & Chicken'";
                        $stmt = DatabaseHelper::runQuery($conn, $sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $result['COUNT(*)'];

                        ?> Items</span>
                <a href="../PHP/products.php?category=Meat_Chicken"><span class="material-symbols-outlined" id="catarrow">
                        arrow_forward
                    </span></a>
            </div>

            <!--Box 5-->
            <div class="box box1">
                <img src="../pics/Snacks.png" alt="">
                <h2>Snacks</h2>
                <span><?php
                        $sql = "SELECT COUNT(*) FROM product WHERE category = 'Snacks'";
                        $stmt = DatabaseHelper::runQuery($conn, $sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $result['COUNT(*)'];

                        ?> Items</span>
                <a href="../PHP/products.php?category=Snacks"><span class="material-symbols-outlined" id="catarrow">
                        arrow_forward
                    </span></a>
            </div>

            <!--Box 6-->
            <div class="box box1">
                <img src="../pics/Beverages.png" alt="">
                <h2>Baverages</h2>
                <span><?php
                        $sql = "SELECT COUNT(*) FROM product WHERE category = 'Baverages'";
                        $stmt = DatabaseHelper::runQuery($conn, $sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $result['COUNT(*)'];

                        ?> Items</span>
                <a href="../PHP/products.php?category=Beverages"><span class="material-symbols-outlined" id="catarrow">
                        arrow_forward
                    </span></a>
            </div>

            <!--Box 7-->
            <div class="box box1">
                <img src="../pics/Personal Care.png" alt="">
                <h2>Personal Care</h2>
                <span><?php
                        $sql = "SELECT COUNT(*) FROM product WHERE category = 'Personal Care'";
                        $stmt = DatabaseHelper::runQuery($conn, $sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $result['COUNT(*)'];

                        ?> Items</span>
                <a href="../PHP/products.php?category=Personal Care"><span class="material-symbols-outlined" id="catarrow">
                        arrow_forward
                    </span></a>
            </div>

            <!--Box 8-->
            <div class="box box1">
                <img src="../pics/Cleaning Supplies.png" alt="">
                <h2>Cleaning Supplies</h2>
                <span><?php
                        $sql = "SELECT COUNT(*) FROM product WHERE category = 'Cleaning Supplies'";
                        $stmt = DatabaseHelper::runQuery($conn, $sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo $result['COUNT(*)'];

                        ?> Items</span>
                <a href="../PHP/products.php?category=Cleaning Supplies"><span class="material-symbols-outlined" id="catarrow">
                        arrow_forward
                    </span></a>
            </div>
        </div>

    </section>

    <!--Products Section-->

    <section class="products" id="products">
        <div class="heading">
            <h1>Our Popular <br><span>Products</span></h1>
            <a href="#" class="btn">See All <span class="material-symbols-outlined" id="R-arrow">
                    arrow_forward
                </span></a>
        </div>
    </section>

    <!--Footer Section-->

    <section class="footer" id="footer">
        <div class="footer-container">
            <div class="footer-box">
                <a href="#" class="logo"><span class="material-symbols-outlined">
                        shopping_cart
                    </span> Shop Smart</a>
                <p>Our Social Media Platforms <br>Follow Us !! </p>
                <div class="social">
                    <a href="#"><i class="bx bxl-facebook"></i></a>
                    <a href="#"><i class="bx bxl-instagram"></i></a>
                    <a href="#"><i class="bx bxl-youtube"></i></a>
                    <a href="#"><i class="bx bxl-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-box">
                <h2>Categories</h2>
                <a href="#">Fruits & Vegetables</a>
                <a href="#">Bakery</a>
                <a href="#">Personal Care</a>
                <a href="#">Cleaning Supplies</a>
            </div>
            <div class="footer-box">
                <h2>To partner with us</h2>
                <p>Submit your email for partnerships <br>Here</p>
                <form action="">
                    <i class="bx bx-envelope"></i>
                    <input type="email" placeholder="Enter your email">
                    <i class="bx bx-right-arrow-alt"></i>
                </form>
            </div>
        </div>

        </div>
    </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!--link to js-->
    <script src="../JS/test.js">

    </script>
</body>

</html>