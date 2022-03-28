<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';

if (isset($_POST['id'], $_POST['quantity'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    // get info
    $qrGetInfo = "SELECT * FROM product WHERE id = {$id}";
    $resultGetInfo = $conn->query($qrGetInfo);
    $product = $resultGetInfo->fetch_assoc();    
    // get image
    $qrGetImage = "SELECT name FROM image WHERE product_id = {$id} LIMIT 1";
    $resultGetImage = $conn->query($qrGetImage);
    $GetImage = $resultGetImage->fetch_assoc();
    
    // Info item
    $name = $product['name'];
    $price = $product['price'];
    $image = $GetImage['name'];
    
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
        if(array_key_exists($id, $cart)){
            $cart[$id]['quantity'] += $quantity;
        }else{
            $cart[$id]= array(
                'name' => $name,
                'quantity' => $quantity,
                'price' => $price,
                'image' => $image
            );
        }
    }else{
        $cart = array();
        $cart[$id]= array(
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
            'image' => $image
        );
        
    }
    $_SESSION['cart'] = $cart;
}
?>
