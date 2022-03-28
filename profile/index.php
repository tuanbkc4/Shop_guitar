<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/checkUser.php';
?>
<style>
    .hero {
        display: none;
    }
</style>
<div class="container mt-5 mb-5">
    <div class="row main_profile">
        <div class="col-md-3 left_bar">
            <div class="proflie_avatar text-center mt-4">
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
                <h3><?php echo $_SESSION['arUser']['fullname']; ?></h3>
            </div>
            <ul>
                <li>
                    <a data-toggle="collapse " href="#account" aria-expanded="true" aria-controls="account">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="menu-title">My account</span>
                    </a>
                    <div class="collapse show" id="account">
                        <ul class="border-0 pt-0 pb-0 pr-0 pl-4">
                            <li><a href="/SHOP_GUITAR/profile/index.php" style="color:red">Profile</a></li>
                            <li><a href="/SHOP_GUITAR/profile/address/index.php">Addresses</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="/SHOP_GUITAR/profile/purchase.php">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="menu-title">My purchase</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9 main_content">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Username:</td>
                        <td>tuan123</td>
                    </tr>
                    <tr>
                        <td>Fullname:</td>
                        <td>Bui Duc Tuan</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>Tuan@gmail.com</td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td>Ha Noi</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>0918044509</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- footer -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/footer.php';
?>