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
        <div class="container prodcut_detail">
            <?php
            //   find items 
            $id = $_GET["id"];
            if (is_numeric($id)) {
                $id = (int)$id;
                $qrGetInfo = "SELECT * FROM product WHERE id = {$id}";
                $resultGetInfo = $conn->query($qrGetInfo);
                $product = $resultGetInfo->fetch_assoc();
                if ($resultGetInfo->num_rows == 0) {
                    header('location:index.php?msgDanger=Product không tồn tại');
                    die();
                }
            } else {
                header('location:index.php?msgDanger=Product không tồn tại');
                die();
            }
            ?>
            <div class="card">
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-6">
                            <?php
                            $qrGetImage = "SELECT * FROM image WHERE product_id = {$id}";
                            $resultGetImage = $conn->query($qrGetImage);
                            if ($resultGetImage->num_rows > 0) {
                            ?>
                                <div class="preview-pic tab-content">
                                    <?php
                                            $i = 1;
                                            while ($arImages = $resultGetImage->fetch_assoc()) {
                                                if ($i == 1) {
                                            ?>
                                            <div class="tab-pane active" id="pic-<?php echo $arImages['id'] ?>"><img src="../../../files/images/products/<?php echo $arImages['name']; ?>" /></div>
                                        <?php
                                                } else {
                                        ?>
                                            <div class="tab-pane" id="pic-<?php echo $arImages['id'] ?>"><img src="../../../files/images/products/<?php echo $arImages['name']; ?>" /></div>
                                    <?php
                                                }
                                                $i++;
                                            }
                                    ?>
                                </div>
                                <ul class="preview-thumbnail nav nav-tabs">
                                    <?php
                                            $qrGetImage = "SELECT * FROM image WHERE product_id = {$id}";
                                            $resultGetImage = $conn->query($qrGetImage);
                                            $i = 1;
                                            while ($arImages = $resultGetImage->fetch_assoc()) {
                                                if ($i == 1) {
                                            ?>
                                            <li class="active"><a data-target="#pic-<?php echo $arImages['id'] ?>" data-toggle="tab"><img src="../../../files/images/products/<?php echo $arImages['name']; ?>" /></a></li>
                                        <?php
                                                } else {
                                        ?>
                                            <li><a data-target="#pic-<?php echo $arImages['id'] ?>" data-toggle="tab"><img src="../../../files/images/products/<?php echo $arImages['name']; ?>" /></a></li>
                                    <?php
                                                }
                                                $i++;
                                            }
                                    ?>
                                </ul>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="details col-md-6">
                            <h3 class="product-title"><?php echo $product['name']; ?></h3>
                            <div class="rating">
                                <div class="stars">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                                <span class="review-no"><?php echo $product['rating']; ?> reviews</span>
                            </div>
                            <p class="product-description"><?php echo $product['detail']; ?></p>
                            <h5 class="price">Quantity: <span><?php echo $product['quantity']; ?></span></h5>
                            <h5 class="price">Price: <span><?php echo $product['price']; ?></span></h5>
                            <div class="action">
                                <a class="add-to-cart btn btn-default" href="edit.php?id=<?php echo $product['id']; ?>">edit product</a>
                                <a class="like btn btn-default" href="index.php">back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
    ?>