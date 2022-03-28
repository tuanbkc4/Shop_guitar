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
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Bestseller</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <div class="col-lg-4">
                                    <div class="product__discount__item item_product">
                                        <div class="product__discount__item__pic set-bg" data-setbg="/SHOP_GUITAR/templates/shop/assets/images/product/discount/pd-1.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li>
                                                    <p class="m-0"><a href="#" class="btn btn-success">Buy now</i></a></p>
                                                </li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item item_product">
                                        <div class="product__discount__item__pic set-bg" data-setbg="/SHOP_GUITAR/templates/shop/assets/images/product/discount/pd-2.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li>
                                                    <p class="m-0"><a href="#" class="btn btn-success">Buy now</i></a></p>
                                                </li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Vegetables</span>
                                            <h5><a href="#">Vegetables’package</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item item_product">
                                        <div class="product__discount__item__pic set-bg" data-setbg="/SHOP_GUITAR/templates/shop/assets/images/product/discount/pd-3.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li>
                                                    <p class="m-0"><a href="#" class="btn btn-success">Buy now</i></a></p>
                                                </li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Mixed Fruitss</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item item_product">
                                        <div class="product__discount__item__pic set-bg" data-setbg="/SHOP_GUITAR/templates/shop/assets/images/product/discount/pd-4.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li>
                                                    <p class="m-0"><a href="#" class="btn btn-success">Buy now</i></a></p>
                                                </li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item item_product">
                                        <div class="product__discount__item__pic set-bg" data-setbg="/SHOP_GUITAR/templates/shop/assets/images/product/discount/pd-5.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li>
                                                    <p class="m-0"><a href="#" class="btn btn-success">Buy now</i></a></p>
                                                </li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item item_product">
                                        <div class="product__discount__item__pic set-bg" data-setbg="/SHOP_GUITAR/templates/shop/assets/images/product/discount/pd-6.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li>
                                                    <p class="m-0"><a href="#" class="btn btn-success">Buy now</i></a></p>
                                                </li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <p class="m-0"><a href="#" class="btn btn-success">Buy now</i></a></p>
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
                console.log(data);
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