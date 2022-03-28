<?php
session_start();
ob_start();
$_SESSION['back'] = $_SERVER['REQUEST_URI'];
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop | Guitar</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/bootstrap.min.css" type="text/css">
    <!-- <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/font-awesome.min.css" type="text/css"> -->
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/profile.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/alertify.min.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/default.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.css" integrity="sha512-LKG0Zi6duJ5mwncLtQVchN0iF8fWmcxApuX9pqGq7ITgwQDWR9EqZFsrV9TXfE9pPRa1J6GVnsBl7gKxAyllaA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- js -->
    <script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>

</head>

<body>

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="/SHOP_GUITAR/templates/shop/assets/images/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <?php
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
                $total_price = 0;
                $total_qty = 0;
                foreach ($cart as $item) {
                    $total_qty += $item['quantity'];
                    $total_price += $item['quantity'] * $item['price'];
                }
            ?>
                <ul>
                    <li><a href="/SHOP_GUITAR/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i> <span class="quantity_item_cart"><?php echo $total_qty; ?></span></a></li>
                </ul>
                <div class="header__cart__price">item: <span class="price_cart"><?php echo number_format($total_price, 0, '.', ',') ?> đ</span></div>
            <?php
            } else {
            ?>
                <ul>
                    <li><a href="/SHOP_GUITAR/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i> <span class="quantity_item_cart">0</span></a></li>
                </ul>
                <div class="header__cart__price">item: <span class="price_cart">0đ</span></div>
            <?php
            }
            ?>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="/SHOP_GUITAR/templates/shop/assets/images/language.png" alt="">
                <div>English</div>
                <i class="fa fa-angle-down ml-3" aria-hidden="true"></i>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">

                <?php
                if (isset($_SESSION['arUser'])) {
                ?>
                    <div class="user">
                        <?php
                        if ($_SESSION['arUser']['avt'] != NULL) {
                        ?>
                            <img src="/SHOP_GUITAR/files/images/avatar/<?php echo $_SESSION['arUser']['avt']; ?>" alt="">
                        <?php
                        } else {
                        ?>
                            <img src="/SHOP_GUITAR/files/images/avatar/default.jpg" alt="">
                        <?php
                        }
                        ?>
                        <a href="/SHOP_GUITAR/profile/"><?php echo $_SESSION['arUser']['fullname']; ?></a> | <a href="/SHOP_GUITAR/auth/logout.php"> Logout </i> </a>
                    </div>
                <?php
                } else {
                ?>
                    <a href="/SHOP_GUITAR/auth/login.php"><i class="fa fa-user"></i> Login </a> | <a href="/SHOP_GUITAR/auth/signup.php"> Register </i> </a>
                <?php
                }
                ?>

            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <?php
                $queryCat = "SELECT id FROM category WHERE parent_id IS NOT NULL LIMIT 1";
                $resultCat = $conn->query($queryCat);
                $Cat = $resultCat->fetch_assoc();
                ?>
                <li class="active"><a href="/SHOP_GUITAR/index.php">Home</a></li>
                <li><a href="/SHOP_GUITAR/cat.php?id=<?php echo $Cat['id']; ?>">Shop</a></li>
                <li>Pages
                    <ul class="header__menu__dropdown">
                        <li><a href="/SHOP_GUITAR/detail.php">Shop Details</a></li>
                        <li><a href="/SHOP_GUITAR/cart.php">Shoping Cart</a></li>
                        <li><a href="/SHOP_GUITAR/checkout.php">Check Out</a></li>
                    </ul>
                </li>
                <li><a href="./contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> tuanbachkhoadn@gmail.com</li>
                <li>Guitar Shop</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> tuanbachkhoadn@gmail.com</li>
                                <li>Guitar Shop</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="/SHOP_GUITAR/templates/shop/assets/images/language.png" alt="">
                                <div>English</div>
                                <i class="fa fa-angle-down ml-3" aria-hidden="true"></i>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">

                                <?php
                                if (isset($_SESSION['arUser'])) {
                                ?>
                                    <div class="user">
                                        <?php
                                        if ($_SESSION['arUser']['avt'] != NULL) {
                                        ?>
                                            <img src="/SHOP_GUITAR/files/images/avatar/<?php echo $_SESSION['arUser']['avt']; ?>" alt="">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="/SHOP_GUITAR/files/images/avatar/default.jpg" alt="">
                                        <?php
                                        }
                                        ?>
                                        <a href="/SHOP_GUITAR/profile/"><?php echo $_SESSION['arUser']['fullname']; ?></a> | <a href="/SHOP_GUITAR/auth/logout.php"> Logout </i> </a>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <a href="/SHOP_GUITAR/auth/login.php"><i class="fa fa-user"></i> Login </a> | <a href="/SHOP_GUITAR/auth/signup.php"> Register </i> </a>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="/SHOP_GUITAR/index.php"><img src="/SHOP_GUITAR/templates/shop/assets/images/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="/SHOP_GUITAR/index.php">Home</a></li>
                            <li><a href="/SHOP_GUITAR/cat.php?id=<?php echo $Cat['id']; ?>">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="/SHOP_GUITAR/detail.php">Shop Details</a></li>
                                    <li><a href="/SHOP_GUITAR/cart.php">Shoping Cart</a></li>
                                    <li><a href="/SHOP_GUITAR/checkout.php">Check Out</a></li>
                                </ul>
                            </li>
                            <li><a href="./contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <?php
                        if (isset($_SESSION['cart'])) {
                            $cart = $_SESSION['cart'];
                            $total_price = 0;
                            $total_qty = 0;
                            foreach ($cart as $item) {
                                $total_qty += $item['quantity'];
                                $total_price += $item['quantity'] * $item['price'];
                            }
                        ?>
                            <ul>
                                <li><a href="/SHOP_GUITAR/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i> <span class="quantity_item_cart"><?php echo $total_qty; ?></span></a></li>
                            </ul>
                            <div class="header__cart__price">item: <span class="price_cart"><?php echo number_format($total_price, 0, '.', ',') ?> đ</span></div>
                        <?php
                        } else {
                        ?>
                            <ul>
                                <li><a href="/SHOP_GUITAR/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i> <span class="quantity_item_cart">0</span></a></li>
                            </ul>
                            <div class="header__cart__price">item: <span class="price_cart">0đ</span></div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/heroCat.php';
                    ?>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                </div>
                                <input type="text" placeholder="What do you need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>0918044509</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="/SHOP_GUITAR/templates/shop/assets/images/hero/banner_img.png">
                        <div class="hero__text">
                            <span>SHOP GUITAR</span>
                            <h2>Home of the World's <br> Finest Guitars</h2>
                            <p>See our latest new and pre-owned guitars in Just Arrived</p>
                            <a href="/SHOP_GUITAR/cat.php?id=<?php echo $Cat['id']; ?>" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->