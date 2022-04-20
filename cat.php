<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/header.php';
?>

<?php
$id = $_GET["id"];
if (is_numeric($id)) {
    $id = (int)$id;
    $qrGetInfo = "SELECT * FROM category WHERE id = {$id}";
    $resultGetInfo = $conn->query($qrGetInfo);
    if ($resultGetInfo->num_rows == 0) {
        header('location:index.php?msgDanger=Category không tồn tại');
        die();
    }
} else {
    header('location:index.php?msgDanger=Category không tồn tại');
    die();
}
?>
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <!-- side bar -->
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/sidebar.php';
                ?>
            </div>
            <?php
            $queryListProduct = "SELECT * FROM product WHERE category_id = {$id} ORDER BY id DESC";
            $resultListProduct = $conn->query($queryListProduct);
            if ($resultListProduct->num_rows > 0) {
            ?>
                <div class="col-lg-9 col-md-7">
                    <div class="row">
                        <?php
                        while ($products = $resultListProduct->fetch_assoc()) {
                        ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item item_product">
                                    <?php
                                    $queryGetImage = "SELECT name FROM image WHERE product_id = {$products['id']} LIMIT 1";
                                    $resultImage = $conn->query($queryGetImage);
                                    $image = $resultImage->fetch_assoc();
                                    ?>
                                    <div class="product__item__pic set-bg">
                                        <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" class="img_product" alt="">
                                        <ul class="product__item__pic__hover">
                                            <li>
                                                <p class="m-0"><a href="javascript:void(0)" class="btn btn-success" onclick="buyNow(<?php echo $products['id']; ?>)">Buy now</i></a></p>
                                            </li>
                                            <li><a href="javascript:void(0)" onclick="addCart(<?php echo $products['id']; ?>)"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="detail.php?id=<?php echo $products['id']; ?>"><?php echo $products['name']; ?></a></h6>
                                        <h5><?php echo number_format($products['price'], 0, '.', ',') ?> đ</h5>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="col-lg-9 col-md-7">
                    <h3 class="text-center">Không có sản phẩm</h3>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- Product Section End -->
<script>
    function addCart(id) {
        $.ajax({
            url: 'ajax/cart/addToCart.php',
            type: 'POST',
            cache: false,
            data: {
                id: id,
                quantity: 1,
            },
            success: function(data) {
                alertify.success('Thêm vào giỏ hàng thành công');
            },
            error: function() {
                alert('Đã có lỗi xảy ra');
            }
        });
    };

    function buyNow(id) {
        $.ajax({
            url: 'ajax/cart/buyNow.php',
            type: 'POST',
            cache: false,
            data: {
                id: id,
                quantity: 1,
            },
            success: function(data) {
                window.location = 'checkout.php';
            },
            error: function() {
                alert('Đã có lỗi xảy ra');
            }
        });
    }
</script>
<!-- footer -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/footer.php';
?>