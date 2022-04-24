<?php
session_start();
ob_start();
if (!(isset($_SESSION['arUser']) && $_SESSION['arUser']['role'] == 1)) {
    $_SESSION['loginDanger'] = "Bạn không có quyền truy cập";
    header("Location:/SHOP_GUITAR/");
    die();
}
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/enumOrder.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/limitContact.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/constant.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | Shop Guitar</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/admin/assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/admin/assets/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/admin/assets/vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/admin/assets/css/style.css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/admin/assets/css/custom.css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/admin/assets/css/modal.css">
    <!-- End layout styles -->
    <!-- image upload -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.css" integrity="sha512-LKG0Zi6duJ5mwncLtQVchN0iF8fWmcxApuX9pqGq7ITgwQDWR9EqZFsrV9TXfE9pPRa1J6GVnsBl7gKxAyllaA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/alertify.min.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/default.min.css" type="text/css">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->

        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex align-items-center">
                <a class="navbar-brand brand-logo" href="/SHOP_GUITAR/admin/">
                    <img src="/SHOP_GUITAR/templates/admin/assets/images/logo.svg" alt="logo" class="logo-dark" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="/SHOP_GUITAR/admin/"><img src="/SHOP_GUITAR/templates/admin/assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
                <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome shop dashboard!</h5>
                <ul class="navbar-nav navbar-nav-right ml-auto">
                    <form class="search-form d-none d-md-block" action="#">
                        <i class="icon-magnifier"></i>
                        <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                    </form>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket-loaded"></i></a></li>
                    <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <?php
                            if ($_SESSION['arUser']['avt'] != null) {
                            ?>
                                <img class="img-xs rounded-circle ml-2" src="/SHOP_GUITAR/files/images/avatar/<?php echo  $_SESSION['arUser']['avt']; ?>" alt="Profile image">
                            <?php
                            } else {
                            ?>
                                <img class="img-xs rounded-circle ml-2" src="/SHOP_GUITAR/files/images/avatar/default.jpg" alt="Profile image">
                            <?php
                            }
                            ?>
                            <span class="font-weight-normal"> <?php echo  $_SESSION['arUser']['fullname']; ?> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <?php
                                if ($_SESSION['arUser']['avt'] != null) {
                                ?>
                                    <img class="img-md rounded-circle" style="width:120px;height:120px;" src="/SHOP_GUITAR/files/images/avatar/<?php echo $_SESSION['arUser']['avt']; ?>" alt="Profile image">
                                <?php
                                } else {
                                ?>
                                    <img class="img-md rounded-circle" src="/SHOP_GUITAR/files/images/avatar/default.jpg; ?>" alt="Profile image">
                                <?php
                                }
                                ?>
                                <p class="mb-1 mt-3"><?php echo $_SESSION['arUser']['fullname'] ?></p>
                                <p class="font-weight-light text-muted mb-0"><?php echo $_SESSION['arUser']['email'] ?></p>
                            </div>
                            <a href="/SHOP_GUITAR/profile/" class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile </a>
                            <a href="/SHOP_GUITAR/admin/auth/logout.php" class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>