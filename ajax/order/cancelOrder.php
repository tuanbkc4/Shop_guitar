<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/enumOrder.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // Update order
    $qrUpdate = "UPDATE orders SET status = 4 WHERE id = {$id}";
    $result = $conn->query($qrUpdate);
}
?>

<!-- respone -->

<div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
    <?php
    $queryGetOrder = "SELECT * FROM orders WHERE user_id = {$_SESSION['arUser']['id']}";
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