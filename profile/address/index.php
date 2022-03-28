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
                            <li><a href="/SHOP_GUITAR/profile/index.php">Profile</a></li>
                            <li><a href="/SHOP_GUITAR/profile/address/index.php" style="color:red">Addresses</a></li>
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
            <div class="d-flex border-bottom justify-content-between pb-3 mb-3">
                <h3>My Address</h3>
                <a href="add.php"><button class="btn btn-danger">+ Add new address</button></a>
            </div>
            <?php
            $user_id = $_SESSION['arUser']['id'];
            $queryGetAllAddress = "SELECT * FROM address WHERE user_id = {$user_id}";
            $result = $conn->query($queryGetAllAddress);
            if ($result->num_rows > 0) {
                while ($addresses = $result->fetch_assoc()) {
            ?>
                    <div class="d-flex border-bottom justify-content-between mb-4 align-items-center">
                        <div class="info">
                            <p>Address: <?php echo $addresses['address']; ?></p>
                            <p>Phone: <?php echo $addresses['phone']; ?></p>
                            <?php
                            if ((bool)$addresses['is_default']) {
                            ?>
                                <p class="default">(default)</p>
                            <?php
                            }

                            ?>
                        </div>
                        <div class="action">
                            <a href="edit.php?id=<?php echo $addresses['id']; ?>">edit</a><br/>
                            <a href="remove.php?id=<?php echo $addresses['id']; ?>">remove</a>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <p class="text-center">Không có địa chỉ</p>
            <?php
            }
            ?>

        </div>
    </div>
</div>

<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/alertify.min.js"></script>
<script>
    <?php
    if (isset($_SESSION['createAddress'])) {
    ?>
        alertify.success('Thêm address thành công');
    <?php
        unset($_SESSION['createAddress']);
    }

    if (isset($_SESSION['updateAddress'])) {
    ?>
        alertify.success('Cập nhật address thành công');
    <?php
        unset($_SESSION['updateAddress']);
    }

    if (isset($_SESSION['removeAddress'])) {
        ?>
            alertify.success('Xoá address thành công');
        <?php
            unset($_SESSION['removeAddress']);
        }
    ?>
</script>
<!-- footer -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/footer.php';
?>