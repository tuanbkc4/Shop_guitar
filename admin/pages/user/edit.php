<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/checkInput.php';
?>
<!-- side bar -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/sidebar.php';
?>
<!-- main -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container add_form">
            <div class="row">
                <section class="panel panel-default col-md-8 offset-md-2">
                    <div class="panel-heading">
                        <h3 class="panel-title mb-3">Resset passwrod</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $id = $_GET["id"];
                        if (is_numeric($id)) {
                            $id = (int)$id;
                            $qrGetInfo = "SELECT * FROM user WHERE id = {$id}";
                            $resultGetInfo = $conn->query($qrGetInfo);
                            if ($resultGetInfo->num_rows == 0) {
                                header('location:index.php?msgDanger=User không tồn tại');
                                die();
                            } else {
                                $arInfo = $resultGetInfo->fetch_assoc();
                            }
                        } else {
                            header('location:index.php?msgDanger=User không tồn tại');
                            die();
                        }

                        $username = $arInfo['username'];
                        $password = "";
                        $passwordErr = "";
                        if (isset($_POST['submit'])) {
                            $password = trim($_POST['password']);

                            // password
                            if ($password == "") {
                                $passwordErr = "Vui lòng nhập password";
                            } else {
                                if (!checkPassword($password)) {
                                    $passwordErr = "Password không hợp lệ (password có độ dài 6-32 ký tự,bao gồm số và chữ cái)";
                                }
                            }

                            // reset password
                            if ($passwordErr == "") {
                                $password = md5($password);

                                $queryUpdate = "UPDATE user SET password = '{$password}' WHERE id = {$id}";
                                $result = $conn->query($queryUpdate);
                                if ($result) {
                                    header('location:index.php?msgSuccess=Cập nhật thành công');
                                    die();
                                }
                            }
                        }
                        ?>
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" type="text" name="username" placeholder="username" id="username" value="<?php echo $username; ?>" disabled />
                            </div>
                            <div class="form-group">
                                <label for="password">New password</label>
                                <input class="form-control" type="password" name="password" placeholder="password" id="password" value="<?php echo $password; ?>" />
                                <?php
                                if ($passwordErr != "") {
                                ?>
                                    <span class="error"><?php echo $passwordErr; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                            <button name="submit" class="btn btn-success">Reset</button>
                            <a href="index.php" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <style>

    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
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
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
    ?>