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
                <h3>New Address</h3>
            </div>
            <?php
            $address = $phone = "";
            $addressErr = $phoneErr = "";
            if (isset($_POST['submit'])) {
                $address = trim($_POST['address']);
                $phone = trim($_POST['phone']);
                $user_id = (int)$_SESSION['arUser']['id'];
                // kiểm tra
                // address
                if ($address == "") {
                    $addressErr = "Vui lòng nhập address";
                }

                // phone
                if ($phone == "") {
                    $phoneErr = "Vui lòng nhập phone";
                } else {
                    $qrCheckphone = "SELECT * FROM address WHERE phone = '$phone'";
                    $resultCheck = $conn->query($qrCheckphone);
                    if ($resultCheck->num_rows > 0) {
                        $phoneErr = "phone đã tồn tại";
                    }
                }

                // add address
                if ($addressErr == "" && $phoneErr == "") {
                    if (isset($_POST['default'])) {
                        // reset default
                        $qrUpdateAddress = "UPDATE address SET is_default = 0";
                        $resultUpdateAddress = $conn->query($qrUpdateAddress);
                        // set default                        
                        $qrAddAddess = "INSERT INTO address(address,phone,is_default,user_id) VALUES ('$address','$phone',1,$user_id)";
                        $resultAddAddess = $conn->query($qrAddAddess);
                        if ($resultAddAddess) {
                            $_SESSION['createAddress'] = true;
                            header('location:index.php');
                            die();
                        } else {
                            header('location:login.php');
                            die();
                        }
                    } else {
                        $qrAddAddess = "INSERT INTO address(address,phone,user_id) VALUES ('$address','$phone',$user_id)";
                        $resultAddAddess = $conn->query($qrAddAddess);
                        if ($resultAddAddess) {
                            $_SESSION['createAddress'] = true;
                            header('location:index.php');
                            die();
                        } else {
                            header('location:login.php');
                            die();
                        }
                    }
                }
            }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="address">Addresss</label>
                    <input class="form-control" type="text" name="address" placeholder="address" id="address" value="<?php echo $address; ?>" />
                    <?php
                    if ($addressErr != "") {
                    ?>
                        <span class="error"><?php echo $addressErr; ?></span>
                    <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input class="form-control" type="text" name="phone" placeholder="phone" id="phone" value="<?php echo $phone; ?>" />
                    <?php
                    if ($phoneErr != "") {
                    ?>
                        <span class="error"><?php echo $phoneErr; ?></span>
                    <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="default"> Set as default address
                </div>
                <button name="submit" class="btn btn-primary">Submit</button>

            </form>

        </div>
    </div>
</div>

<!-- footer -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/footer.php';
?>