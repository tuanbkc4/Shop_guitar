<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/header.php';
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
                        <h3 class="panel-title mb-3">Edit Product</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $id = $_GET["id"];
                        if (is_numeric($id)) {
                            $id = (int)$id;
                            $qrGetInfo = "SELECT p.*,c.name AS cname, c.id AS cid FROM product AS p INNER JOIN category AS c ON c.id=p.category_id WHERE p.id = {$id}";
                            $resultGetInfo = $conn->query($qrGetInfo);
                            if ($resultGetInfo->num_rows == 0) {
                                header('location:index.php?msgDanger=Product không tồn tại');
                                die();
                            }
                        } else {
                            header('location:index.php?msgDanger=Product không tồn tại');
                            die();
                        }
                        $product = $resultGetInfo->fetch_assoc();
                        $nameProduct = $product["name"];
                        $category = $product["cid"];
                        $price = $product["price"];
                        $quantity = $product["quantity"];
                        $productDescription = $product["detail"];
                        $picture = "";
                        $oldImage = [];
                        $nameProductErr = $categoryErr = $priceErr = $quantityErr = $productDescriptionErr = $pictureErr = "";
                        if (isset($_POST['submit'])) {
                            $nameProduct = trim($_POST['name_product']);
                            $category = trim($_POST['product_category']);
                            $price = trim($_POST['price']);
                            $quantity = trim($_POST['quantity']);
                            $productDescription = trim($_POST['Prodcut_description']);
                            $oldImage = $_POST['oldImage'];
                            // $picture = $_FILES['picture']['name'];

                            // Kiểm tra
                            // name
                            if ($nameProduct == "") {
                                $nameProductErr = "Vui lòng nhập tên sản phẩm";
                            } else {
                                $qrCheckname = "SELECT id FROM product WHERE name ='{$nameProduct}' && id != {$id} ";
                                $resultCheck = $conn->query($qrCheckname);
                                if ($resultCheck->num_rows > 0) {
                                    $nameProductErr = "Tên sản phẩm đã tồn tại";
                                }
                            }

                            // category
                            if ($category == "") {
                                $categoryErr = "Vui lòng chọn danh mục";
                            }

                            // price
                            if ($price == "") {
                                $priceErr = "Vui lòng nhập giá sản phẩm";
                            } else if ($price < 0) {
                                $priceErr = "Giá sản phẩm không hợp lệ";
                            }

                            // quantity
                            if ($quantity == "") {
                                $quantityErr = "Vui lòng nhập số lượng sản phẩm";
                            } else if ($quantity < 0) {
                                $quantityErr = "Số lượng sản phẩm không hợp lệ";
                            }

                            // productDescription
                            if ($productDescription == "") {
                                $productDescriptionErr = "Vui lòng nhập mô tả sản phẩm";
                            }
                            // picture
                            if (isset($_FILES['picture'])) {
                                $picture = $_FILES['picture'];
                                $count_picture = count($_FILES['picture']['name']) + count($oldImage);
                                if (strlen($_FILES['picture']['name']['0']) > 0) {
                                    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
                                    if ($count_picture > 5) {
                                        $pictureErr = "Số lượng ảnh upload không được quá 5 files";
                                    } else {
                                        for ($i = 0; $i < count($_FILES['picture']['name']); $i++) {
                                            $name = $picture['name'][$i];
                                            $tmp = explode(".", $name);
                                            $file_extension = end($tmp);
                                            if (!in_array($file_extension, $allowed)) {
                                                $pictureErr = "files không hợp lệ";
                                            }
                                        }
                                    }
                                }
                            }
                            if ($nameProductErr == "" && $categoryErr == "" && $priceErr == "" && $quantityErr == "" && $productDescriptionErr == "" && $pictureErr == "") {
                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                $datetime = date('Y:m:d H:i:s');

                                $queryInsert = "UPDATE  product
                                                SET name = '$nameProduct',detail='$productDescription',price= $price,quantity= $quantity,category_id = $category ,updated_at = '$datetime'
                                                WHERE id = {$id}";
                                $resultInsert = $conn->query($queryInsert);
                                if ($resultInsert) {
                                    $queryCheckImages = "SELECT * FROM image WHERE product_id = {$id}";
                                    $resultCheckImages = $conn->query($queryCheckImages);
                                    if ($resultCheckImages->num_rows > 0) {
                                        // xoá file image
                                        while ($arInfoImage = $resultCheckImages->fetch_assoc()) {
                                            if (!in_array($arInfoImage['id'], $oldImage)) {
                                                unlink($_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/files/images/products/' . $arInfoImage['name']);
                                                $qrRemoveImage = "DELETE FROM image WHERE id = {$arInfoImage['id']}";
                                                $resultRemoveImage = $conn->query($qrRemoveImage);
                                            }
                                        }
                                    }

                                    if (strlen($_FILES['picture']['name']['0']) > 0) {
                                        for ($i = 0; $i < count($_FILES['picture']['name']); $i++) {
                                            $name = $picture['name'][$i];
                                            $tmp = explode(".", $name);
                                            $file_extension = end($tmp);
                                            $nameSaveFile = "SG - " . time() . $i . '.' . $file_extension;

                                            $tmp_name = $picture['tmp_name'][$i];
                                            $path_upload = $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/files/images/products/' . $nameSaveFile;
                                            move_uploaded_file($tmp_name, $path_upload);

                                            $queryInsertPicture = "INSERT INTO image(name,product_id) VALUES ('$nameSaveFile', $id)";
                                            $resultInsertPicture = $conn->query($queryInsertPicture);
                                        }
                                    }
                                    header('location:index.php?msgSuccess=Cập nhật sản phẩm thành công');
                                    die();
                                } else {
                                    header('location:index.php?msgDanger= Có lỗi khi Cập nhật sản phẩm');
                                    die();
                                }
                            }
                        }
                        ?>
                        <form action="#" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name_product">Product Name</label>
                                <input type="text" name="name_product" value="<?php echo $nameProduct; ?>" class="form-control form-input" id="name_product" placeholder="Prodcut Name">
                                <?php
                                if ($nameProductErr != "") {
                                ?>
                                    <span class="error"><?php echo $nameProductErr; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="Category">Product Category</label>
                                <select class="form-control form-input" name="product_category" id="Category">
                                    <option value="">-- Choose product category --</option>
                                    <?php
                                    $queryGetCategory = "SELECT id,name FROM category WHERE parent_id IS NOT NULL";
                                    $resultGetCategory = $conn->query($queryGetCategory);
                                    while ($arrayGetCategory = $resultGetCategory->fetch_assoc()) {

                                    ?>

                                        <option value="<?php echo $arrayGetCategory['id']; ?>" <?php echo ($category == $arrayGetCategory['id'] ? "selected" : ""); ?>><?php echo $arrayGetCategory['name']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <?php
                                if ($categoryErr != "") {
                                ?>
                                    <span class="error"><?php echo $categoryErr; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" value="<?php echo $price; ?>" class="form-control form-input" id="price" placeholder="price">
                                    <?php
                                    if ($priceErr != "") {
                                    ?>
                                        <span class="error"><?php echo $priceErr; ?></span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="Quantity">Quantity</label>
                                    <input type="number" name="quantity" value="<?php echo $quantity; ?>" class="form-control form-input" id="Quantity" placeholder="Quantity">
                                    <?php
                                    if ($quantityErr != "") {
                                    ?>
                                        <span class="error"><?php echo $quantityErr; ?></span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Prodcut_description">Prodcut description</label>
                                <textarea rows="6" type="number" name="Prodcut_description" class="form-control form-input ckeditor" id="Prodcut_description" placeholder="Prodcut description"><?php echo $productDescription; ?></textarea>
                                <?php
                                if ($productDescriptionErr != "") {
                                ?>
                                    <span class="error"><?php echo $productDescriptionErr; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <label class="dandev_insert_attach "><span>Add file +</span></label>
                                <div class="wrap">
                                    <div class="dandev-reviews">
                                        <?php
                                        $qrGetImage = "SELECT * FROM image WHERE product_id = {$id}";
                                        $resultGetImage = $conn->query($qrGetImage);
                                        $haveImage = false;
                                        if ($resultGetImage->num_rows > 0) {
                                            $haveImage = true;
                                        }
                                        ?>
                                        <div class="list_attach <?php echo ($haveImage ? 'show-btn' : ''); ?>">
                                            <ul class="dandev_attach_view">
                                                <span class="dandev_insert_attach"><i class="dandev-plus">+</i></span>
                                                <?php
                                                if ($haveImage) {
                                                    while ($arImages = $resultGetImage->fetch_assoc()) {
                                                ?>
                                                        <li>
                                                            <div class="img-wrap"><span class="close" onclick="DelImg(this)">×</span>
                                                                <div class="img-wrap-box"><img src="../../../files/images/products/<?php echo $arImages['name']; ?>"></div>
                                                            </div>
                                                            <input type="hidden" name="oldImage[]" value="<?php echo $arImages['id']; ?>">
                                                        </li>
                                                <?php
                                                    }
                                                }
                                                ?>

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
                            </div>
                            <div class="form_group">
                                <input type="submit" value="Update product" name="submit" class="btn btn-success">
                                <a class="btn btn-warning" href="index.php">Back</a>
                            </div>
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
        let maxItem = 5;
        let i = $("input[type='hidden']").length;
        $(document).ready(function() {
            if(i >= maxItem){
                $('.dandev_insert_attach ').addClass('d-none');
            }
        });
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
                    _html += '<input type="file" class="hidden" name="picture[]"  onchange="uploadImg(this)" id="files_' + _time + '"  />';
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
                if (i >= maxItem) {
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
            console.log(i);
            jQuery(el).closest('li').remove();

        }
    </script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
    ?>