<a href="javascript:void(0)" class="edit btn-show-<?php echo $order_id; ?>">
    <ion-icon name="eye-outline"></ion-icon>
</a>
<div class="modal modal-show-<?php echo $order_id; ?>">
    <div class="modal-content">
        <span class="close text-right">&times;</span>
        <div class="container">
            <div class="row">
                <div class="detail col-6">
                    <?php
                    $queryGetOrder = "SELECT * FROM orders WHERE id = $order_id";
                    $resultGetOrder = $conn->query($queryGetOrder);
                    while ($orders = $resultGetOrder->fetch_assoc()) {
                    ?>
                        <div class="order_item d-flex flex-column">
                            <div class="item_info_order">
                                <h3 class="text-left mb-3">Chi tiết đơn hàng</h3>
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
                                            <div class="text-left">
                                                <p class="name_product mb-1"><?php echo $product['name']; ?></p>
                                                <p class="qty_prduct mb-1">x <?php echo $order_details['quantity']; ?></p>
                                                <p class="price_product">Tổng: <?php echo number_format($order_details['quantity'] * $order_details['price'], 0, '.', ','); ?>đ</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-6 mt-3">
                    <?php

                    $getInforUser = "SELECT * FROM (SELECT o.*,u.fullname FROM orders AS o INNER JOIN USER AS u ON o.user_id = u.id) AS ou INNER JOIN address AS a ON ou.address_id = a.id WHERE ou.id = $order_id";
                    $resultGetinforUser = $conn->query($getInforUser);
                    $row = $resultGetinforUser->fetch_assoc();
                    ?>
                    <table class="ml-auto mr-3 text-left">
                        <tr>
                            <td>Họ tên</td>
                            <td><?php echo $row['fullname'] ?></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td><?php echo $row['address'] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $row['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Trạng thái</td>
                            <td><?php echo checkStatus($row['status']); ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><?php echo number_format($row['total_price'], 0, '.', ','); ?></td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>




<link rel="stylesheet" href="/SHOP_GUITAR/templates/admin/assets/css/modal.css">
<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {
        var modal = $('.modal-show-<?php echo $order_id; ?>');
        var btn = $('.btn-show-<?php echo $order_id; ?>');
        var span = $('.close');

        btn.click(function() {
            modal.show();
        });

        span.click(function() {
            modal.hide();
        });

        $(window).on('click', function(e) {
            if ($(e.target).is('modal-show-<?php echo $order_id; ?>')) {
                modal.hide();
            }
        });
    });
</script>