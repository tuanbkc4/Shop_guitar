<?php
session_start();
ob_start();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.css" integrity="sha512-LKG0Zi6duJ5mwncLtQVchN0iF8fWmcxApuX9pqGq7ITgwQDWR9EqZFsrV9TXfE9pPRa1J6GVnsBl7gKxAyllaA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
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
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="/SHOP_GUITAR/index.php">Home</a></li>
                <li><a href="/SHOP_GUITAR/products.php">Shop</a></li>
                <li>Pages
                    <ul class="header__menu__dropdown">
                        <li><a href="/SHOP_GUITAR/productDetail.php">Shop Details</a></li>
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
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> tuanbachkhoadn@gmail.com</li>
                                <li>Guitar Shop</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
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
                                <a href="#"><i class="fa fa-user"></i> Login</a>
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
                            <li><a href="/SHOP_GUITAR/products.php">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="/SHOP_GUITAR/productDetail.php">Shop Details</a></li>
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
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>$150.00</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->