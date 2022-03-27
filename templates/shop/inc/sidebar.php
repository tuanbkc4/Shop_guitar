<div class="sidebar">
    <?php
    $queryListProduct = "SELECT * FROM product WHERE category_id = {$id} ORDER BY id DESC";
    $resultListProduct = $conn->query($queryListProduct);
    if ($resultListProduct->num_rows > 0) {
    ?>
        <div class="sidebar__item">
            <h4>Price</h4>
            <div class="price-range-wrap">
                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="10" data-max="540">
                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                </div>
                <div class="range-slider">
                    <div class="price-input">
                        <input type="text" id="minamount">
                        <input type="text" id="maxamount">
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="latest-product__text">
                <h4>Latest Products</h4>
                <div class="latest-product__slider owl-carousel">
                    <div class="latest-prdouct__slider__item">
                        <?php
                        $queryLatestProducts = "SELECT * FROM product ORDER BY id DESC LIMIT 3";
                        $resultLatestProducts = $conn->query($queryLatestProducts);
                        if ($resultLatestProducts->num_rows > 0) {
                            while ($products = $resultLatestProducts->fetch_assoc()) {
                        ?>
                                <a href="detail.php?id=<?php echo $products['id']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <?php
                                        $queryGetImage = "SELECT name FROM image WHERE product_id = {$products['id']} LIMIT 1";
                                        $resultImage = $conn->query($queryGetImage);
                                        $image = $resultImage->fetch_assoc();
                                        ?>
                                        <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $products['name']; ?></h6>
                                        <span><?php echo number_format($products['price'], 0, '.', ',') ?> đ</span>
                                    </div>
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="latest-prdouct__slider__item">
                        <?php
                        $queryLatestProducts = "SELECT * FROM product ORDER BY id DESC LIMIT 3,3";
                        $resultLatestProducts = $conn->query($queryLatestProducts);
                        if ($resultLatestProducts->num_rows > 0) {
                            while ($products = $resultLatestProducts->fetch_assoc()) {
                        ?>
                                <a href="detail.php?id=<?php echo $products['id']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <?php
                                        $queryGetImage = "SELECT name FROM image WHERE product_id = {$products['id']} LIMIT 1";
                                        $resultImage = $conn->query($queryGetImage);
                                        $image = $resultImage->fetch_assoc();
                                        ?>
                                        <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $products['name']; ?></h6>
                                        <span><?php echo number_format($products['price'], 0, '.', ',') ?> đ</span>
                                    </div>
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    <?php
    }
    ?>

</div>