<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/header.php';
?>
<!-- best seller -->
<!-- best seller -->
<?php
$getProductSeller = " SELECT * FROM product AS p INNER JOIN (
                            SELECT product_id, SUM(quantity) AS TotalQuantity
                            FROM order_detail
                            GROUP BY product_id
                            ORDER BY SUM(quantity) DESC
                            LIMIT 6
                        ) AS pid ON p.id = pid.product_id";
$resultProductSeller = $conn->query($getProductSeller);
if ($resultProductSeller->num_rows >  0) {
?>
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Bestseller</h2>
                    </div>
                </div>
                <div class="product__discount__slider owl-carousel mb-4">
                    <?php
                    while ($productSeller = $resultProductSeller->fetch_assoc()) {
                        $queryGetImage = "SELECT name FROM image WHERE product_id = {$productSeller['id']} LIMIT 1";
                        $resultImage = $conn->query($queryGetImage);
                        $image = $resultImage->fetch_assoc();
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item item_product">
                                <?php
                                $queryGetImage = "SELECT name FROM image WHERE product_id = {$productSeller['id']} LIMIT 1";
                                $resultImage = $conn->query($queryGetImage);
                                $image = $resultImage->fetch_assoc();
                                ?>
                                <div class="product__item__pic set-bg">
                                    <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" class="img_product" alt="">
                                    <ul class="product__item__pic__hover">
                                        <li>
                                            <p class="m-0"><a href="javascript:void(0)" class="btn btn-success" onclick="buyNow(<?php echo $productSeller['id']; ?>)">Buy now</i></a></p>
                                        </li>
                                        <li><a href="javascript:void(0)" onclick="addCart(<?php echo $productSeller['id']; ?>)"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="detail.php?id=<?php echo $productSeller['id']; ?>"><?php echo $productSeller['name']; ?></a></h6>
                                    <h5><?php echo number_format($productSeller['price'], 0, '.', ',') ?> đ</h5>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>
        </div>
    </section>
<?php
}
?>
<!-- banner -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="/SHOP_GUITAR/templates/shop/assets/images/banner/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="/SHOP_GUITAR/templates/shop/assets/images/banner/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <?php
                        $getCat = "SELECT name,id FROM category INNER JOIN (
                                        SELECT category_id,created_at FROM product GROUP BY category_id ORDER BY created_at DESC LIMIT 4
                                        ) AS cid ON cid.category_id = category.id";
                        $resultGetCat = $conn->query($getCat);
                        $arrCat = array();
                        while ($arGetCat = $resultGetCat->fetch_assoc()) {
                            $arrCat[] = $arGetCat['id'];
                        ?>
                            <li data-filter=".cat-<?php echo $arGetCat['id'] ?>"><?php echo $arGetCat['name'] ?></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php
            foreach ($arrCat as $item) {
                $getProduct = "SELECT * FROM product WHERE category_id = {$item} LIMIT 4";
                $resultGetProduct = $conn->query($getProduct);
                while ($row = $resultGetProduct->fetch_assoc()) {
            ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix cat-<?php echo $item; ?>">
                        <div class="product__item item_product">
                            <?php
                            $queryGetImage = "SELECT name FROM image WHERE product_id = {$row['id']} LIMIT 1";
                            $resultImage = $conn->query($queryGetImage);
                            $image = $resultImage->fetch_assoc();
                            ?>
                            <div class="product__item__pic set-bg">
                                <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" class="img_product" alt="">
                                <ul class="product__item__pic__hover">
                                    <li>
                                        <p class="m-0"><a href="javascript:void(0)" class="btn btn-success" onclick="buyNow(<?php echo $row['id']; ?>)">Buy now</i></a></p>
                                    </li>
                                    <li><a href="javascript:void(0)" onclick="addCart(<?php echo $row['id']; ?>)"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h6>
                                <h5><?php echo number_format($row['price'], 0, '.', ',') ?> đ</h5>
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
<!-- Featured Section End -->


<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/alertify.min.js"></script>
<script>
    <?php
    if (isset($_SESSION['orderDanger'])) {
    ?>
        alertify.error('<?php echo $_SESSION['orderDanger']; ?>');
    <?php
        unset($_SESSION['orderDanger']);
    }
    ?>

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