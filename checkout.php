<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/header.php';
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
                        <div class="form-group">
                            <label for="addresss">Address - Phone</label>
                            <select class="form-control select_address" id="addresss">disabled="disabled"
                                <option value="">Choose address</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="other_address">
                                Add other address
                                <input type="checkbox" id="other_address">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input d-none other_address">
                            <p>Address<span>*</span></p>
                            <input type="text">
                        </div>
                        <div class="checkout__input d-none other_address">
                            <p>Phone<span>*</span></p>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                <li>Vegetable’s Package <span>$75.99</span></li>
                                <li>Fresh Vegetable <span>$151.99</span></li>
                                <li>Organic Bananas <span>$53.99</span></li>
                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div>
                            <div class="checkout__order__total">Total <span>$750.99</span></div>
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

    $('#other_address').click(function() {
        $('.other_address').toggleClass('d-none');
        // $('.select_address').attr("disabled", true);
        if ($('.select_address').attr('disabled')) {
            $('.select_address').removeAttr('disabled');
        } else {
            $('.select_address').attr('disabled', true);
        }
    });
</script>
<!-- footer -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/footer.php';
?>