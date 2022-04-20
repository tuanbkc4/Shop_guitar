<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/shop/inc/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/checkUser.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/enumOrder.php';
?>
<style>
    .hero {
        display: none;
    }
</style>
<div class="container mt-5 mb-5">
    <div class="row main_profile">
        <div class="col-md-3 left_bar">
            <div class="proflie_avatar text-center mt-4">
                <?php
                if ($_SESSION['arUser']['avt'] != NULL) {
                ?>
                    <img src="/SHOP_GUITAR/files/images/avatar/<?php echo $_SESSION['arUser']['avt']; ?>" alt="">
                <?php
                } else {
                ?>
                    <img src="/SHOP_GUITAR/files/images/avatar/default.jpg" alt="">
                <?php
                }
                ?>
                <h3><?php echo $_SESSION['arUser']['fullname']; ?></h3>
            </div>
            <ul>
                <li>
                    <a data-toggle="collapse" href="#account" aria-expanded="false" aria-controls="account">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="menu-title">My account</span>
                    </a>
                    <div class="collapse" id="account">
                        <ul class="border-0 pt-0 pb-0 pr-0 pl-4">
                            <li><a href="/SHOP_GUITAR/profile/index.php">Profile</a></li>
                            <li><a href="/SHOP_GUITAR/profile/address/index.php">Addresses</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="/SHOP_GUITAR/profile/purchase.php">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="menu-title" style="color:red">My purchase</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9 main_content">
            <section id="tabs">
                <nav class="mb-4">
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">All</a>
                        <a class="nav-item nav-link" id="nav-pay-tab" data-toggle="tab" href="#nav-pay" role="tab" aria-controls="nav-pay" aria-selected="false">To Pay</a>
                        <a class="nav-item nav-link" id="nav-ship-tab" data-toggle="tab" href="#nav-ship" role="tab" aria-controls="nav-ship" aria-selected="false">To Ship</a>
                        <a class="nav-item nav-link" id="nav-receive-tab" data-toggle="tab" href="#nav-receive" role="tab" aria-controls="nav-receive" aria-selected="false">To Receive</a>
                        <a class="nav-item nav-link" id="nav-completed-tab" data-toggle="tab" href="#nav-completed" role="tab" aria-controls="nav-completed" aria-selected="false">Completed</a>
                        <a class="nav-item nav-link" id="nav-cancelled-tab" data-toggle="tab" href="#nav-cancelled" role="tab" aria-controls="nav-cancelled" aria-selected="false">Cancelled</a>
                    </div>
                </nav>

                <div class="tab-content py-2 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                        <form action="#" method="POST" class="mb-3">
                            <input type="text" name="search" oninput="searchOrder(<?php echo $_SESSION['arUser']['id']; ?>)" class="search_order form-control py-4" placeholder="Search by Order ID or Product Name in all orders">
                        </form>
                        <div class="all_order">
                            <?php
                            if (isset($valueSearch) && $valueSearch != "") {
                                $queryGetOrder = "SELECT * FROM orders WHERE user_id = {$user_id} AND id IN((SELECT od.order_id FROM order_detail AS od INNER JOIN product AS p ON p.id = od.product_id WHERE p.name LIKE '%$valueSearch%')) ORDER BY id DESC";
                                $resultGetOrder = $conn->query($queryGetOrder);
                            } else {
                                $queryGetOrder = "SELECT * FROM orders WHERE user_id = {$_SESSION['arUser']['id']} ORDER BY id DESC";
                                $resultGetOrder = $conn->query($queryGetOrder);
                            }
                            while ($orders = $resultGetOrder->fetch_assoc()) {
                            ?>
                                <div class="order_item d-flex flex-column my-4">
                                    <div class="action_order text-right mb-4">
                                        <?php
                                        if ($orders['status'] == 0) {
                                        ?>
                                            <button class="btn btn-warning p-1 mr-3 " onclick="cancelOrder(<?php echo $orders['id']; ?>)">Cancel Order</button>
                                        <?php
                                        }
                                        ?>
                                        <p class="d-inline-block pl-3 status_order"><?php echo checkStatus($orders['status']); ?></p>
                                    </div>
                                    <div class="item_info_order">
                                        <?php
                                        $queryGetOrderDetail = "SELECT * FROM order_detail WHERE order_id = {$orders['id']}";
                                        $resultGetOrderDetail = $conn->query($queryGetOrderDetail);
                                        while ($order_details = $resultGetOrderDetail->fetch_assoc()) {
                                        ?>
                                            <div class="info_order d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <?php
                                                    $getProduct = "SELECT name FROM product WHERE id = {$order_details['product_id']}";
                                                    $resultGetProduct = $conn->query($getProduct);
                                                    $product = $resultGetProduct->fetch_assoc();

                                                    $getImage = "SELECT name FROM image WHERE product_id = {$order_details['product_id']}";
                                                    $resultGetImage = $conn->query($getImage);
                                                    $image = $resultGetImage->fetch_assoc();
                                                    ?>
                                                    <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" alt="">
                                                    <div>
                                                        <p class="name_product"><?php echo $product['name']; ?></p>
                                                        <p class="qty_prduct">x <?php echo $order_details['quantity']; ?></p>
                                                    </div>
                                                </div>
                                                <p class="price_product"><?php echo number_format($order_details['quantity'] * $order_details['price'], 0, '.', ','); ?>đ</p>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="total_order_item text-right">
                                        <p>Tottal : <span class="price_product"><?php echo number_format($orders['total_price'], 0, '.', ','); ?>đ</span></p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="nav-pay" role="tabpanel" aria-labelledby="nav-pay-tab">
                        <?php
                        $queryGetOrder = "SELECT * FROM orders WHERE user_id = {$_SESSION['arUser']['id']} && status = 0";
                        $resultGetOrder = $conn->query($queryGetOrder);
                        while ($orders = $resultGetOrder->fetch_assoc()) {
                        ?>
                            <div class="order_item d-flex flex-column mb-4">
                                <div class="action_order text-right mb-4">
                                    <?php
                                    if ($orders['status'] == 0) {
                                    ?>
                                        <button class="btn btn-warning p-1 mr-3 " onclick="cancelOrder(<?php echo $orders['id']; ?>)">Cancel Order</button>
                                    <?php
                                    }
                                    ?>
                                    <p class="d-inline-block pl-3 status_order"><?php echo checkStatus($orders['status']); ?></p>
                                </div>
                                <div class="item_info_order">
                                    <?php
                                    $queryGetOrderDetail = "SELECT * FROM order_detail WHERE order_id = {$orders['id']}";
                                    $resultGetOrderDetail = $conn->query($queryGetOrderDetail);
                                    while ($order_details = $resultGetOrderDetail->fetch_assoc()) {
                                    ?>
                                        <div class="info_order d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <?php
                                                $getProduct = "SELECT name FROM product WHERE id = {$order_details['product_id']}";
                                                $resultGetProduct = $conn->query($getProduct);
                                                $product = $resultGetProduct->fetch_assoc();

                                                $getImage = "SELECT name FROM image WHERE product_id = {$order_details['product_id']}";
                                                $resultGetImage = $conn->query($getImage);
                                                $image = $resultGetImage->fetch_assoc();
                                                ?>
                                                <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" alt="">
                                                <div>
                                                    <p class="name_product"><?php echo $product['name']; ?></p>
                                                    <p class="qty_prduct">x <?php echo $order_details['quantity']; ?></p>
                                                </div>
                                            </div>
                                            <p class="price_product"><?php echo number_format($order_details['quantity'] * $order_details['price'], 0, '.', ','); ?>đ</p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="total_order_item text-right">
                                    <p>Tottal : <span class="price_product"><?php echo number_format($orders['total_price'], 0, '.', ','); ?>đ</span></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="tab-pane fade" id="nav-ship" role="tabpanel" aria-labelledby="nav-ship-tab">
                        <?php
                        $queryGetOrder = "SELECT * FROM orders WHERE user_id = {$_SESSION['arUser']['id']} && status = 1";
                        $resultGetOrder = $conn->query($queryGetOrder);
                        while ($orders = $resultGetOrder->fetch_assoc()) {
                        ?>
                            <div class="order_item d-flex flex-column mb-4">
                                <div class="action_order text-right mb-4">
                                    <?php
                                    if ($orders['status'] == 0) {
                                    ?>
                                        <button class="btn btn-warning p-1 mr-3 " onclick="cancelOrder(<?php echo $orders['id']; ?>)">Cancel Order</button>
                                    <?php
                                    }
                                    ?>
                                    <p class="d-inline-block pl-3 status_order"><?php echo checkStatus($orders['status']); ?></p>
                                </div>
                                <div class="item_info_order">
                                    <?php
                                    $queryGetOrderDetail = "SELECT * FROM order_detail WHERE order_id = {$orders['id']}";
                                    $resultGetOrderDetail = $conn->query($queryGetOrderDetail);
                                    while ($order_details = $resultGetOrderDetail->fetch_assoc()) {
                                    ?>
                                        <div class="info_order d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <?php
                                                $getProduct = "SELECT name FROM product WHERE id = {$order_details['product_id']}";
                                                $resultGetProduct = $conn->query($getProduct);
                                                $product = $resultGetProduct->fetch_assoc();

                                                $getImage = "SELECT name FROM image WHERE product_id = {$order_details['product_id']}";
                                                $resultGetImage = $conn->query($getImage);
                                                $image = $resultGetImage->fetch_assoc();
                                                ?>
                                                <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" alt="">
                                                <div>
                                                    <p class="name_product"><?php echo $product['name']; ?></p>
                                                    <p class="qty_prduct">x <?php echo $order_details['quantity']; ?></p>
                                                </div>
                                            </div>
                                            <p class="price_product"><?php echo number_format($order_details['quantity'] * $order_details['price'], 0, '.', ','); ?>đ</p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="total_order_item text-right">
                                    <p>Tottal : <span class="price_product"><?php echo number_format($orders['total_price'], 0, '.', ','); ?>đ</span></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="tab-pane fade" id="nav-receive" role="tabpanel" aria-labelledby="nav-receive-tab">
                        <?php
                        $queryGetOrder = "SELECT * FROM orders WHERE user_id = {$_SESSION['arUser']['id']} && status = 2";
                        $resultGetOrder = $conn->query($queryGetOrder);
                        while ($orders = $resultGetOrder->fetch_assoc()) {
                        ?>
                            <div class="order_item d-flex flex-column mb-4">
                                <div class="action_order text-right mb-4">
                                    <?php
                                    if ($orders['status'] == 0) {
                                    ?>
                                        <button class="btn btn-warning p-1 mr-3 " onclick="cancelOrder(<?php echo $orders['id']; ?>)">Cancel Order</button>
                                    <?php
                                    }
                                    ?>
                                    <p class="d-inline-block pl-3 status_order"><?php echo checkStatus($orders['status']); ?></p>
                                </div>
                                <div class="item_info_order">
                                    <?php
                                    $queryGetOrderDetail = "SELECT * FROM order_detail WHERE order_id = {$orders['id']}";
                                    $resultGetOrderDetail = $conn->query($queryGetOrderDetail);
                                    while ($order_details = $resultGetOrderDetail->fetch_assoc()) {
                                    ?>
                                        <div class="info_order d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <?php
                                                $getProduct = "SELECT name FROM product WHERE id = {$order_details['product_id']}";
                                                $resultGetProduct = $conn->query($getProduct);
                                                $product = $resultGetProduct->fetch_assoc();

                                                $getImage = "SELECT name FROM image WHERE product_id = {$order_details['product_id']}";
                                                $resultGetImage = $conn->query($getImage);
                                                $image = $resultGetImage->fetch_assoc();
                                                ?>
                                                <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" alt="">
                                                <div>
                                                    <p class="name_product"><?php echo $product['name']; ?></p>
                                                    <p class="qty_prduct">x <?php echo $order_details['quantity']; ?></p>
                                                </div>
                                            </div>
                                            <p class="price_product"><?php echo number_format($order_details['quantity'] * $order_details['price'], 0, '.', ','); ?>đ</p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="total_order_item text-right">
                                    <p>Tottal : <span class="price_product"><?php echo number_format($orders['total_price'], 0, '.', ','); ?>đ</span></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-completed-tab">
                        <?php
                        $queryGetOrder = "SELECT * FROM orders WHERE user_id = {$_SESSION['arUser']['id']} && status = 3";
                        $resultGetOrder = $conn->query($queryGetOrder);
                        while ($orders = $resultGetOrder->fetch_assoc()) {
                        ?>
                            <div class="order_item d-flex flex-column mb-4">
                                <div class="action_order text-right mb-4">
                                    <?php
                                    if ($orders['status'] == 0) {
                                    ?>
                                        <button class="btn btn-warning p-1 mr-3 " onclick="cancelOrder(<?php echo $orders['id']; ?>)">Cancel Order</button>
                                    <?php
                                    }
                                    ?>
                                    <p class="d-inline-block pl-3 status_order"><?php echo checkStatus($orders['status']); ?></p>
                                </div>
                                <div class="item_info_order">
                                    <?php
                                    $queryGetOrderDetail = "SELECT * FROM order_detail WHERE order_id = {$orders['id']}";
                                    $resultGetOrderDetail = $conn->query($queryGetOrderDetail);
                                    while ($order_details = $resultGetOrderDetail->fetch_assoc()) {
                                    ?>
                                        <div class="info_order d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <?php
                                                $getProduct = "SELECT name FROM product WHERE id = {$order_details['product_id']}";
                                                $resultGetProduct = $conn->query($getProduct);
                                                $product = $resultGetProduct->fetch_assoc();

                                                $getImage = "SELECT name FROM image WHERE product_id = {$order_details['product_id']}";
                                                $resultGetImage = $conn->query($getImage);
                                                $image = $resultGetImage->fetch_assoc();
                                                ?>
                                                <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" alt="">
                                                <div>
                                                    <p class="name_product"><?php echo $product['name']; ?></p>
                                                    <p class="qty_prduct">x <?php echo $order_details['quantity']; ?></p>
                                                </div>
                                            </div>
                                            <p class="price_product"><?php echo number_format($order_details['quantity'] * $order_details['price'], 0, '.', ','); ?>đ</p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="total_order_item text-right">
                                    <p>Tottal : <span class="price_product"><?php echo number_format($orders['total_price'], 0, '.', ','); ?>đ</span></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="tab-pane fade" id="nav-cancelled" role="tabpanel" aria-labelledby="nav-cancelled-tab">
                        <?php
                        $queryGetOrder = "SELECT * FROM orders WHERE user_id = {$_SESSION['arUser']['id']} && status = 4";
                        $resultGetOrder = $conn->query($queryGetOrder);
                        while ($orders = $resultGetOrder->fetch_assoc()) {
                        ?>
                            <div class="order_item d-flex flex-column mb-4">
                                <div class="action_order text-right mb-4">
                                    <?php
                                    if ($orders['status'] == 0) {
                                    ?>
                                        <button class="btn btn-warning p-1 mr-3 " onclick="cancelOrder(<?php echo $orders['id']; ?>)">Cancel Order</button>
                                    <?php
                                    }
                                    ?>
                                    <p class="d-inline-block pl-3 status_order"><?php echo checkStatus($orders['status']); ?></p>
                                </div>
                                <div class="item_info_order">
                                    <?php
                                    $queryGetOrderDetail = "SELECT * FROM order_detail WHERE order_id = {$orders['id']}";
                                    $resultGetOrderDetail = $conn->query($queryGetOrderDetail);
                                    while ($order_details = $resultGetOrderDetail->fetch_assoc()) {
                                    ?>
                                        <div class="info_order d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <?php
                                                $getProduct = "SELECT name FROM product WHERE id = {$order_details['product_id']}";
                                                $resultGetProduct = $conn->query($getProduct);
                                                $product = $resultGetProduct->fetch_assoc();

                                                $getImage = "SELECT name FROM image WHERE product_id = {$order_details['product_id']}";
                                                $resultGetImage = $conn->query($getImage);
                                                $image = $resultGetImage->fetch_assoc();
                                                ?>
                                                <img src="/SHOP_GUITAR/files/images/products/<?php echo $image['name']; ?>" alt="">
                                                <div>
                                                    <p class="name_product"><?php echo $product['name']; ?></p>
                                                    <p class="qty_prduct">x <?php echo $order_details['quantity']; ?></p>
                                                </div>
                                            </div>
                                            <p class="price_product"><?php echo number_format($order_details['quantity'] * $order_details['price'], 0, '.', ','); ?>đ</p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="total_order_item text-right">
                                    <p>Tottal : <span class="price_product"><?php echo number_format($orders['total_price'], 0, '.', ','); ?>đ</span></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </section>

        </div>
    </div>
</div>

<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>
<script src="/SHOP_GUITAR/templates/shop/assets/js/alertify.min.js"></script>
<script>
    <?php
    if (isset($_SESSION['orderSuccess'])) {
    ?>
        alertify.success('Đặt hàng thành công');
    <?php
        unset($_SESSION['orderSuccess']);
    }
    ?>

    function cancelOrder(id) {
        $.ajax({
            url: '../ajax/order/cancelOrder.php',
            type: 'POST',
            cache: false,
            data: {
                id: id,
            },
            success: function(data) {
                $('.tab-content').html(data)
                alertify.success('Huỷ đơn hàng thành công');
            },
            error: function() {
                alert('Đã có lỗi xảy ra');
            }
        });
    }

    function searchOrder(user_id) {
        let valueSearch = $('.search_order ').val();
        $.ajax({
            url: '../ajax/order/searchOrder.php',
            type: 'POST',
            cache: false,
            data: {
                user_id: user_id,
                valueSearch: valueSearch,
            },
            success: function(data) {
                $('.all_order').html(data)

                // alertify.success('Huỷ đơn hàng thành công');
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