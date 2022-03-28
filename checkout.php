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
            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group  mb-5 pb-4 border-bottom">
                            <label for="addresss">Address - Phone</label>
                            <?php
                            $queryGetAddress = "SELECT * FROM address WHERE user_id = {$_SESSION['arUser']['id']}";
                            $resultGetAddress = $conn->query($queryGetAddress);
                            if ($resultGetAddress->num_rows > 0) {
                            ?>
                                <select class="form-control select_address" id="addresss">
                                    <?php
                                    while ($address = $resultGetAddress->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $address['id'];?>"><?php echo $address['address'];?> - <?php echo $address['phone'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php
                            }
                            ?>

                        </div>
                        <div class="checkout__input other_address">
                            <p>Address:</p>
                            <input type="text" class="address" readonly>
                        </div>
                        <div class="checkout__input other_address">
                            <p>Phone:</p>
                            <input type="text" class="phone" readonly>
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
                        <div class="checkout__input__checkbox">
                            <label for="payment">
                                Check Payment
                                <input type="checkbox" id="payment">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="paypal">
                                Paypal
                                <input type="checkbox" id="paypal">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    // console.log($('#other_address'));
    // console.log($('.select_address'));
    $('.select_address').change(function(){
        console.log($('.select_address').val());
        // console.log($('.address'));
    });                            
    // $('#other_address').click(function() {
    //     $('.other_address').toggleClass('d-none');
    //     // $('.select_address').attr("disabled", true);
    //     if ($('.select_address').attr('disabled')) {
    //         $('.select_address').removeAttr('disabled');
    //     } else {
    //         $('.select_address').attr('disabled', true);
    //     }
    // });
</script>
<!-- footer -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/footer.php';
?>