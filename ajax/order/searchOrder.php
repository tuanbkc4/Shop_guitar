<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/enumOrder.php';

if (isset($_POST['user_id'], $_POST['valueSearch'])) {
    $user_id = $_POST['user_id'];
    $valueSearch = $_POST['valueSearch'];
}
?>

<!-- respone -->

<div class="all_order">
    <?php
    if (isset($valueSearch) && $valueSearch != "") {
        $queryGetOrder = "SELECT * FROM orders WHERE user_id = {$user_id} AND id IN((SELECT od.order_id FROM order_detail AS od INNER JOIN product AS p ON p.id = od.product_id WHERE p.name LIKE '%$valueSearch%'))";
        $resultGetOrder = $conn->query($queryGetOrder);
    } else {
        $queryGetOrder = "SELECT * FROM orders WHERE user_id = {$_SESSION['arUser']['id']}";
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