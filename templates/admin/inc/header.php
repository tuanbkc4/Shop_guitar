<?php
session_start();
ob_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Shop Guitar</title>
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
    <!-- End layout styles -->
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->

        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex align-items-center">
                <a class="navbar-brand brand-logo" href="index.php">
                    <img src="/SHOP_GUITAR/templates/admin/assets/images/logo.svg" alt="logo" class="logo-dark" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.php"><img src="/SHOP_GUITAR/templates/admin/assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
                <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome shop dashboard!</h5>
                <ul class="navbar-nav navbar-nav-right ml-auto">
                    <form class="search-form d-none d-md-block" action="#">
                        <i class="icon-magnifier"></i>
                        <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                    </form>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket-loaded"></i></a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="icon-chart"></i></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <i class="icon-speech"></i>
                            <span class="count">7</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                            <a class="dropdown-item py-3">
                                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="/SHOP_GUITAR/templates/admin/assets/images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="/SHOP_GUITAR/templates/admin/assets/images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="/SHOP_GUITAR/templates/admin/assets/images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown language-dropdown d-none d-sm-flex align-items-center">
                        <a class="nav-link d-flex align-items-center dropdown-toggle" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="d-inline-flex mr-3">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <span class="profile-text font-weight-normal">English</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
                            <a class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i> English </a>
                            <a class="dropdown-item">
                                <i class="flag-icon flag-icon-fr"></i> French </a>
                            <a class="dropdown-item">
                                <i class="flag-icon flag-icon-ae"></i> Arabic </a>
                            <a class="dropdown-item">
                                <i class="flag-icon flag-icon-ru"></i> Russian </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle ml-2" src="/SHOP_GUITAR/templates/admin/assets/images/faces/face8.jpg" alt="Profile image"> <span class="font-weight-normal"> Admin </span></a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="/SHOP_GUITAR/templates/admin/assets/images/faces/face8.jpg" alt="Profile image">
                                <p class="mb-1 mt-3">Allen Moreno</p>
                                <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p>
                            </div>
                            <a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                            <a class="dropdown-item"><i class="dropdown-item-icon icon-speech text-primary"></i> Messages</a>
                            <a class="dropdown-item"><i class="dropdown-item-icon icon-energy text-primary"></i> Activity</a>
                            <a class="dropdown-item"><i class="dropdown-item-icon icon-question text-primary"></i> FAQ</a>
                            <a class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>