<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';

if (isset($_POST['id'],$_POST['quantity'])) {
    $id = $_POST['id'];
    // get info
    $qrGetInfo = "SELECT * FROM product WHERE id = {$id}";
    $resultGetInfo = $conn->query($qrGetInfo);
    $product = $resultGetInfo->fetch_assoc();    
    // get image
    $qrGetImage = "SELECT name FROM image WHERE product_id = {$id} LIMIT 1";
    $resultGetImage = $conn->query($qrGetImage);
    $GetImage = $resultGetImage->fetch_assoc();
    
    // Info item
    $product_id = $id;
    $name = $product['name'];
    $quantity = $_POST['quantity'];
    $price = $product['price'];
    $image = $GetImage['name'];

    $cart= array(
        'product_id' => $product_id,
        'name' => $name,
        'quantity' => $quantity,
        'price' => $price,
        'image' => $image
    );        
    
    $_SESSION['buyNow'] = $cart;
    
}
?>
