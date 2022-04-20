<?php
session_start();
ob_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';

if (!isset($_SESSION['arUser'])) {
    header("Location:/SHOP_GUITAR/auth/login.php?msgDanger=Vui lòng đăng nhập");
}

if (empty($_SESSION['cart']) && empty($_SESSION['buyNow'])) {
    $_SESSION['orderDanger'] = 'Bạn chưa chọn sản phẩm';
    header("Location:/SHOP_GUITAR/");
    die();
}
$total_price = 0;
if (isset($_POST['submit'])) {
    if (isset($_SESSION['buyNow'])) {
        $cart = $_SESSION['buyNow'];

        $total_price = $cart['price'] * $cart['quantity'];
    } else {
        $cart = $_SESSION['cart'];
        foreach ($cart as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }
    }
    $total_price = (int)$total_price;
    $user_id = (int)$_SESSION['arUser']['id'];
    $payment_id = (int)$_POST['payment'];
    $address_id = (int)$_POST['address'];
    // Tạo order
    $queryOrder = "INSERT INTO orders(total_price,user_id,payment_id,address_id) VALUES ({$total_price},{$user_id},{$payment_id},{$address_id})";
    $resultOrder = $conn->query($queryOrder);

    // Tạo order detail    
    if ($resultOrder) {
        if (isset($_SESSION['buyNow'])) {
            $product_id = $cart['product_id'];
            $order_id = $conn->insert_id;
            $quantity = $cart['quantity'];
            $price = $cart['price'];
            $queryOrderDetail = "INSERT INTO order_detail(product_id,order_id,quantity,price) VALUES ({$product_id},{$order_id},{$quantity},{$price})";
            $resultOrderDetail = $conn->query($queryOrderDetail);
            // Xoá Session
            unset($_SESSION['buyNow']);
        } else {
            $order_id = $conn->insert_id;
            foreach ($cart as $product_id => $item) {
                $quantity = $item['quantity'];
                $price = $item['price'];
                $queryOrderDetail = "INSERT INTO order_detail(product_id,order_id,quantity,price) VALUES ({$product_id},{$order_id},{$quantity},{$price})";
                $resultOrderDetail = $conn->query($queryOrderDetail);
            }
            // Xoá Session
            unset($_SESSION['cart']);
        }
    }


    // Chuyển hướng
    $_SESSION['orderSuccess'] = true;
    header("Location:/SHOP_GUITAR/profile/purchase.php");
}
