<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/checkInput.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Guitar | Signup</title>
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/SHOP_GUITAR/templates/shop/assets/css/auth.css" type="text/css">

</head>

<body>
    <div class="container right-panel-active" id="container">
        <!-- <div class="form-container sign-up-container">
           
        </div> -->
        <div class="form-container sign-in-container">
            <?php
            $username = $password = $fullname = $email = "";
            $usernameErr = $passwordErr = $fullnameErr = $emailErr = $pictureErr = "";
            if (isset($_POST['submit'])) {
                // echo '<pre>';
                //   print_r($_POST);
                // echo '</pre>';
                $fullname = trim($_POST['fullname']);
                $username = trim($_POST['username']);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                if (isset($_FILES['avatar'])) {
                    $picture = $_FILES['avatar'];

                    //kiểm tra Picture
                    $allowed = array('jpg', 'jpeg', 'png', 'gif');
                    $name = $picture['name'];
                    $tmp = explode(".", $name);
                    $file_extension = strtolower(end($tmp));
                    if (!in_array($file_extension, $allowed)) {
                        $pictureErr = "avatar không hợp lệ (jpg, jpeg, png, gif)";
                    }
                }

                // kiểm tra
                // Username
                if ($username == "") {
                    $usernameErr = "Vui lòng nhập username";
                } else {
                    if (!checkUsername($username)) {
                        $usernameErr = "Username không hợp lệ";
                    } else {
                        $qrCheckUsername = "SELECT * FROM user WHERE username = '$username'";
                        $resultCheck = $conn->query($qrCheckUsername);
                        if ($resultCheck->num_rows > 0) {
                            $usernameErr = "username đã tồn tại";
                        }
                    }
                }
                // password
                if ($password == "") {
                    $passwordErr = "Vui lòng nhập password";
                } else {
                    if (!checkPassword($password)) {
                        $passwordErr = "Password không hợp lệ (password có độ dài 6-32 ký tự,bao gồm số và chữ cái)";
                    }
                }
                // fullname
                if ($fullname == "") {
                    $fullnameErr = "Vui lòng nhập fullname";
                } else {
                    if (!checkName($fullname)) {
                        $fullnameErr = "fullname không hợp lệ";
                    }
                }

                // email
                if ($email == "") {
                    $emailErr = "Vui lòng nhập email";
                } else {
                    if (!checkEmail($email)) {
                        $emailErr = "email không hợp lệ";
                    }else{
                        $qrCheckEmail = "SELECT * FROM user WHERE email = '$email'";
                        $resultCheck = $conn->query($qrCheckEmail);
                        if ($resultCheck->num_rows > 0) {
                            $emailErr = "email đã tồn tại";
                        }
                    }
                }
                // add user
                if ($usernameErr == "" && $passwordErr == "" && $fullnameErr == "" && $emailErr == "" && $pictureErr == "") {
                    $password = md5($password);
                    if (isset($picture)) {
                        // Đăng ký user có avt
                        // upload ảnh
                        $name = $picture['name'];
                        $tmp = explode(".", $name);
                        $file_extension = strtolower(end($tmp));
                        $nameSaveFile = "avt-" . time() . '.' . $file_extension;

                        $tmp_name = $picture['tmp_name'];
                        $path_upload = $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/files/images/avatar/' . $nameSaveFile;
                        move_uploaded_file($tmp_name, $path_upload);

                        // thực hiên câu truy vấn
                        $qrAddUser = "INSERT INTO user(username,fullname,email,password,avt) VALUES ('$username','$fullname','$email','$password','$nameSaveFile')";
                        $resultAddUser = $conn->query($qrAddUser);
                        if ($resultAddUser) {
                            $_SESSION['username'] = $username;
                            $_SESSION['createAcount'] = true;
                            header('location:login.php');
                            die();
                        } else {
                            header('location:login.php');
                            unlink($path_upload);
                            die();
                        }
                    } else {
                        // Đăng ký user không có avt
                        // thực hiên câu truy vấn 

                        $qrAddUser = "INSERT INTO user(username,fullname,email,password) VALUES ('$username','$fullname','$email','$password')";
                        $resultAddUser = $conn->query($qrAddUser);
                        if ($resultAddUser) {
                            $_SESSION['username'] = $username;
                            $_SESSION['createAcount'] = true;
                            header('location:login.php');
                            die();
                        } else {
                            header('location:login.php');
                            unlink($path_upload);
                            die();
                        }
                    }
                }
            }
            ?>
            <form action="#" method="POST" enctype="multipart/form-data">
                <h2>Create Account</h2>
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="username" id="username" value="<?php echo $username; ?>" />
                <?php
                if ($usernameErr != "") {
                ?>
                    <span class="error"><?php echo $usernameErr; ?></span>
                <?php
                }
                ?>

                <label for="fullname">Fullname</label>
                <input type="text" name="fullname" placeholder="fullname" id="fullname" value="<?php echo $fullname; ?>" />
                <?php
                if ($fullnameErr != "") {
                ?>
                    <span class="error"><?php echo $fullnameErr; ?></span>
                <?php
                }
                ?>

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="email" id="email" value="<?php echo $email; ?>" />
                <?php
                if ($emailErr != "") {
                ?>
                    <span class="error"><?php echo $emailErr; ?></span>
                <?php
                }
                ?>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="password" id="password" value="<?php echo $password; ?>" />
                <?php
                if ($passwordErr != "") {
                ?>
                    <span class="error"><?php echo $passwordErr; ?></span>
                <?php
                }
                ?>
                <div class="avatar">
                    <label for="avatar">Avatar</label>
                    <label class="dandev_insert_attach"><span>Choose avatar</span></label>
                </div>
                <div class="wrap">
                    <div class="dandev-reviews">
                        <div class="list_attach">
                            <ul class="dandev_attach_view">
                                <span class="dandev_insert_attach"><i class="dandev-plus">+</i></span>

                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                if ($pictureErr != "") {
                ?>
                    <span class="error"><?php echo $pictureErr; ?></span>
                <?php
                }
                ?>

                <button name="submit">Sign Up</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <a href="login.php"><button class="ghost" id="signIn">Sign In</button></a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        Bui Duc Tuan - Lap trinh php | Shop Guitar
    </footer>
    <script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>
</body>
<script type="text/javascript">
    let i = 0;
    let maxItem = 1;
    $('.dandev_insert_attach').click(function() {
        if (i < maxItem) {
            if ($('.list_attach').hasClass('show-btn') === false) {
                $('.list_attach').addClass('show-btn');
            }

            var _lastimg = jQuery('.dandev_attach_view li').last().find('input[type="file"]').val();

            if (_lastimg != '') {
                var d = new Date();
                var _time = d.getTime();
                var _html = '<li id="li_files_' + _time + '" class="li_file_hide">';
                _html += '<div class="img-wrap">';
                _html += '<span class="close" onclick="DelImg(this)">×</span>';
                _html += ' <div class="img-wrap-box"></div>';
                _html += '</div>';
                _html += '<div class="' + _time + '">';
                _html += '<input type="file" class="hidden" name="avatar"  onchange="uploadImg(this)" id="files_' + _time + '"  />';
                _html += '</div>';
                _html += '</li>';
                jQuery('.dandev_attach_view').append(_html);
                jQuery('.dandev_attach_view li').last().find('input[type="file"]').click();
            } else {
                if (_lastimg == '') {
                    jQuery('.dandev_attach_view li').last().find('input[type="file"]').click();
                } else {
                    if ($('.list_attach').hasClass('show-btn') === true) {
                        $('.list_attach').removeClass('show-btn');
                    }
                }
            }
            i++;
            if (i == maxItem) {
                $('.dandev_insert_attach ').addClass('d-none');
            }
        }


    });

    function uploadImg(el) {
        var file_data = $(el).prop('files')[0];
        var type = file_data.type;
        var fileToLoad = file_data;

        var fileReader = new FileReader();

        fileReader.onload = function(fileLoadedEvent) {
            var srcData = fileLoadedEvent.target.result;

            var newImage = document.createElement('img');
            newImage.src = srcData;
            var _li = $(el).closest('li');
            if (_li.hasClass('li_file_hide')) {
                _li.removeClass('li_file_hide');
            }
            _li.find('.img-wrap-box').append(newImage.outerHTML);


        }
        fileReader.readAsDataURL(fileToLoad);

    }

    function DelImg(el) {
        $('.dandev_insert_attach').each(function(index, item) {
            item.classList.remove("d-none")
        });
        i--;
        jQuery(el).closest('li').remove();

    }
</script>

</html>