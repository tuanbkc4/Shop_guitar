<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/header.php';
?>
<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $cart = $_SESSION['cart'];
                                $total = 0;
                                foreach ($cart as $id => $item) {
                                    $total += $item['quantity'] * $item['price'];
                            ?>
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="width: 100px;height:100px;object-fit:cover" src="/SHOP_GUITAR/files/images/products/<?php echo $item['image']; ?>" alt="">
                                            <a href="detail.php?id=<?php echo $id ?>" class="name_item_cart"><?php echo $item['name']; ?></a>
                                        </td>
                                        <td class="shoping__cart__price">
                                            <?php echo $item['price']; ?>đ
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input class="qty qty-<?php echo $id; ?>" name="<?php echo $id; ?>" type="number" min="0" value="<?php echo $item['quantity']; ?>">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            <?php echo $item['quantity'] * $item['price']; ?>
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <button class="remove_item_cart" name="<?php echo $id; ?>">
                                                <i class="fa fa-times " aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns border-bottom pb-5">
                    <a href="index.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <?php
                        if (isset($_SESSION['cart'])) {
                        ?>
                            <li>Subtotal <span><?php echo number_format($total, 0, '.', ',') ?> đ</span></li>
                            <li>Total <span><?php echo number_format($total, 0, '.', ',') ?> đ</span></li>
                        <?php
                        } else {
                        ?>
                            <li>Subtotal <span>0 đ</span></li>
                            <li>Total <span>0 đ</span></li>
                        <?php
                        }
                        ?>
                    </ul>
                    <!-- <a href="checkout.php" class="primary-btn">PROCEED TO CHECKOUT</a> -->
                    <a href="javascript:void(0)" class="primary-btn checkout_cart">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/alertify.min.js"></script>
<script>
    $('.qty').on('keypress', function (event) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
        event.preventDefault();
        return false;
        }
    });
    // change quantity
    $(".shoping-cart").on("change", ".qty", function() {
        var id = this.name
        var quantity = this.value;
        $.ajax({
            url: 'ajax/cart/updateCart.php',
            type: 'POST',
            cache: false,
            data: {
                id: id,
                quantity: quantity,
            },
            success: function(data) {
                $('.shoping-cart').html(data)
                alertify.success('Cập nhật giỏ hàng thành công');
            },
            error: function() {
                alert('Đã có lỗi xảy ra');
            }
        });
    });
    // remove item cart
    $(".shoping-cart").on("click", ".remove_item_cart", function() {
        var id = this.name
        $.ajax({
            url: 'ajax/cart/removeItemCart.php',
            type: 'POST',
            cache: false,
            data: {
                id: id
            },
            success: function(data) {
                $('.shoping-cart').html(data)
                alertify.success('Cập nhật giỏ hàng thành công');
            },
            error: function() {
                alert('Đã có lỗi xảy ra');
            }
        });
    });

    $(".shoping-cart").on("click", ".checkout_cart", function() {
        <?php
        if (empty($_SESSION['cart']) && empty($_SESSION['buyNow'])) {
            $_SESSION['orderDanger'] = 'Bạn chưa chọn sản phẩm';
        }
        ?>
        window.location = 'checkout.php';
    });
</script>
<!-- footer -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/footer.php';
?>