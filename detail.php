<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/header.php';
?>

<?php
//   find items 
$id = $_GET["id"];
if (is_numeric($id)) {
    $id = (int)$id;
    $qrGetInfo = "SELECT * FROM product WHERE id = {$id}";
    $resultGetInfo = $conn->query($qrGetInfo);
    if ($resultGetInfo->num_rows == 0) {
        header('location:index.php?msgDanger=Product không tồn tại');
        die();
    } else {
        $product = $resultGetInfo->fetch_assoc();
    }
} else {
    header('location:index.php?msgDanger=Product không tồn tại');
    die();
}

$category_id = $product['category_id'];
?>

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <?php
            $queryGetImage = "SELECT name FROM image WHERE product_id = {$id} LIMIT 1";
            $resultImage = $conn->query($queryGetImage);
            $image = $resultImage->fetch_assoc();
            ?>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <?php
                        $queryGetImages = "SELECT name FROM image WHERE product_id = {$id}";
                        $resultImages = $conn->query($queryGetImages);
                        while ($images = $resultImages->fetch_assoc()) {
                        ?>
                            <img data-imgbigurl="/SHOP_GUITAR/files/images/products/<?php echo $images['name']; ?>" src="/SHOP_GUITAR/files/images/products/<?php echo $images['name']; ?>" alt="">
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?php echo $product['name']; ?></h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price"><?php echo number_format($product['price'], 0, '.', ',') ?> đ</div>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1" class="qty">
                            </div>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">BUY NOW</a>
                    <a href="javascript:void(0)" class="cart-icon" onclick="addCart(<?php echo $id;?>)"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span></a>
                    <ul>
                        <li><b>Availability</b> <span>In Stock</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <?php echo $product['detail']; ?>
                            </div>
                        </div>

                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                    Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                    sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                    eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                    Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                    sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                    diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                    ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                    Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                    Proin eget tortor risus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php
            $queryRelatedProduct = "SELECT * FROM product WHERE category_id = {$category_id} && id != {$id} LIMIT 4";
            $resultRelateProduct = $conn->query($queryRelatedProduct);
            if ($resultRelateProduct->num_rows > 0) {
                while ($products = $resultRelateProduct->fetch_assoc()) {
            ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
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
                                    <li><a href="javascript:void(0)" onclick="addCart(<?php echo $products['id'];?>)"><i class="fa fa-shopping-cart"></i></a></li>
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
            }
            ?>

        </div>
    </div>
</section>
<!-- Related Product Section End -->
<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./index.html"><img src="/SHOP_GUITAR/templates/shop/assets/images/logo.png" alt=""></a>
                    </div>
                    <ul>
                        <li>Address: Ha Noi</li>
                        <li>Phone: 0918044509</li>
                        <li>Email: tuanbachkhoadn@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Useful Links</h6>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">About Our Shop</a></li>
                        <li><a href="#">Secure Shopping</a></li>
                        <li><a href="#">Delivery infomation</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Our Sitemap</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Projects</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Innovation</a></li>
                        <li><a href="#">Testimonials</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Join Our Newsletter Now</h6>
                    <p>Get E-mail updates about our latest shop and special offers.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your mail">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__widget__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>Bui Duc Tuan | Lap trinh PHP</p>
                    </div>
                    <div class="footer__copyright__payment"><img src="/SHOP_GUITAR/templates/shop/assets/images/payment-item.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/bootstrap.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery.nice-select.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-ui.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery.slicknav.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/mixitup.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/owl.carousel.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/main.js"></script>
<!-- alertify -->
<script src="/SHOP_GUITAR/templates/shop/assets/js/alertify.min.js"></script>
<script>
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function() {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });
    
    let quantity = $('.qty').val();
    function addCart(id){
        $.ajax({
            url: 'ajax/cart/addToCart.php',
            type: 'POST',
            cache: false,
            data: { 
                id: id,
                quantity: quantity,
            },
            success: function(data) {
                alertify.success('Thêm vào giỏ hàng thành công');
            },
            error: function() {
                alert('Đã có lỗi xảy ra');
            }
        });
    }
</script>

</body>

</html>
<?php
ob_end_flush();
?>