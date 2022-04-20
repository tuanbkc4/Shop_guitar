<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/checkInput.php';
?>

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <i class="fa fa-phone icon_contact" aria-hidden="true"></i>
                    <h4>Phone</h4>
                    <p>0918044509</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <i class="fa fa-map-marker icon_contact" aria-hidden="true"></i>
                    <h4>Address</h4>
                    <p>Ha Noi</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <i class="fa fa-clock-o icon_contact" aria-hidden="true"></i>
                    <h4>Open time</h4>
                    <p>8:00 am to 17:00 pm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <i class="fa fa-envelope-o icon_contact" aria-hidden="true"></i>
                    <h4>Email</h4>
                    <p>tuanbachkhoadn@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d8857.267967841908!2d105.78328153866275!3d21.031788041874126!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1648204836646!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>Ha Noi</h4>
            <ul>
                <li>Phone: 0918044509</li>
                <li>Add: Cau Giay</li>
            </ul>
        </div>
    </div>
</div>
<!-- Map End -->

<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2 id="form_contact">Leave Message</h2>
                </div>
            </div>
        </div>
        <?php
        if (isset($_SESSION['arUser'])) {
            $name = $_SESSION['arUser']['fullname'];
            $email = $_SESSION['arUser']['email'];
        } else {
            $name = "";
            $email = "";
        }
        $nameErr = "";
        $emailErr = "";
        $content = "";
        $contentErr = "";
        if (isset($_POST['submit'])) {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $content = trim($_POST['content']);
            
            // kiểm tra
            // name
            if ($name == "") {
                $nameErr = "Vui lòng nhập name";
            } else {
                if (!checkName($name)) {
                    $nameErr = "name không hợp lệ";
                }
            }

            // email
            if ($email == "") {
                $emailErr = "Vui lòng nhập email";
            } else {
                if (!checkEmail($email)) {
                    $emailErr = "email không hợp lệ";
                }
            }

            // content
            if ($content == "") {
                $contentErr = "Vui lòng nhập nội dung";
            }

            if ($nameErr == "" && $emailErr == "" && $contentErr == "") {
                $qrInsert = "INSERT INTO contact(name,email,content) VALUES ('$name','$email','$content')";
                $result = $conn->query($qrInsert);
                if ($result) {
                    $_SESSION['sendSuccess'] = true;
                }
            }
        }
        ?>
        <form action="#form_contact" method="POST">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-2">
                    <input class="mb-0" type="text" name="name" value="<?php echo $name; ?>" placeholder="Your name">
                    <?php
                    if ($nameErr != "") {
                    ?>
                        <span class="error mb-2"><?php echo $nameErr; ?></span>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-lg-6 col-md-6 mb-2">
                    <input class="mb-0" type="email" name="email" value="<?php echo $email; ?>" placeholder="Your Email">
                    <?php
                    if ($emailErr != "") {
                    ?>
                        <span class="error mb-2"><?php echo $emailErr; ?></span>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-lg-12">
                    <textarea class="mb-0" name="content" placeholder="Your message"></textarea>
                    <?php
                    if ($contentErr != "") {
                    ?>
                        <span class="error mb-2"><?php echo $contentErr; ?></span>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-lg-12 text-center">
                    <button type="submit" name="submit" class="site-btn">SEND MESSAGE</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Contact Form End -->
<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/alertify.min.js"></script>
<script>
    <?php
    if (isset($_SESSION['sendSuccess'])) {
    ?>
        alertify.success('Gửi liên hệ thành công');
    <?php
        unset($_SESSION['sendSuccess']);
    }
    ?>
</script>
<!-- footer -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/footer.php';
?>