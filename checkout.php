<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/header.php';
if (!isset($_SESSION['arUser'])) {
    header("Location:/SHOP_GUITAR/auth/login.php?msgDanger=Vui lòng đăng nhập");
}
?>

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                </h6>
            </div>
        </div>
        <div class="checkout__form">
            <h4>Billing Details</h4>
            
            <form action="order.php" method="POST">
                <div class="row">
                    <div class="address col-lg-6 col-md-6">
                        <div class="form-group  mb-4">
                            <label for="addresss">Address - Phone</label>

                            <?php
                            $queryGetAddress = "SELECT * FROM address WHERE user_id = {$_SESSION['arUser']['id']}";
                            $resultGetAddress = $conn->query($queryGetAddress);
                            if ($resultGetAddress->num_rows > 0) {
                            ?>
                                <select class="form-control select_address" id="addresss" name="address">
                                    <?php
                                    while ($address = $resultGetAddress->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $address['id']; ?>"><?php echo $address['address']; ?> - <?php echo $address['phone']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php
                            }
                            ?>

                        </div>
                        <div class="form-group">
                            <label class="d-block" for="addresss">Payment</label>
                            <div>
                                <?php
                                $queryGetPayment = "SELECT * FROM payment";
                                $resultGetPayment = $conn->query($queryGetPayment);
                                $checked = 'checked';
                                while ($payment = $resultGetPayment->fetch_assoc()) {
                                ?>
                                    <input type="radio" id="p-<?php echo $payment['id']; ?>" name="payment" value="<?php echo $payment['id']; ?>" <?php echo $checked; ?>>
                                    <label for="p-<?php echo $payment['id']; ?>"><?php echo $payment['name']; ?></label><br>
                                <?php
                                    $checked = "";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                <?php
                                if (isset($_SESSION['cart'])) {
                                    $cart = $_SESSION['cart'];
                                    $total = 0;
                                    foreach ($cart as $key => $item) {
                                        $total += $item['quantity'] * $item['price'];
                                ?>
                                        <li><?php echo $item['name']; ?> <span><?php echo number_format($item['quantity'] * $item['price'], 0, '.', ','); ?> đ</span></li>
                                    <?php
                                    }
                                    ?>
                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span><?php echo number_format($total, 0, '.', ','); ?> đ</span></div>
                            <div class="checkout__order__total">Total <span><?php echo number_format($total, 0, '.', ','); ?> đ</span></div>
                        <?php
                                }
                        ?>
                        <button type="submit" name="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<!-- footer -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/footer.php';
?>