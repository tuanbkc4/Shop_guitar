<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="/SHOP_GUITAR/profile/" class="nav-link">
                    <div class="profile-image">
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
                        <div class="dot-indicator bg-success"></div>
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name"><?php echo  $_SESSION['arUser']['fullname']; ?></p>
                        <p class="designation">Administrator</p>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/SHOP_GUITAR/admin">
                    <span class="menu-title">Dashboard</span>
                    <i class="icon-screen-desktop menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/SHOP_GUITAR/admin/pages/products">
                    <span class="menu-title">Products</span>
                    <i class="icon-globe menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/SHOP_GUITAR/admin/pages/cat">
                    <span class="menu-title">Category</span>
                    <i class="icon-book-open menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/SHOP_GUITAR/admin/pages/user">
                    <span class="menu-title">Users</span>
                    <i class="icon-user menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/SHOP_GUITAR/admin/pages/order">
                    <span class="menu-title">Orders</span>
                    <i class="icon-basket menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/SHOP_GUITAR/admin/pages/contact">
                    <span class="menu-title">Contact</span>
                    <i class="icon-envelope-open menu-icon"></i>
                </a>
            </li>
        </ul>
    </nav>