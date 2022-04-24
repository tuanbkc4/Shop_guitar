<?php
    session_start();
    ob_start();

    unset($_SESSION['arUser']);
    header("location:/SHOP_GUITAR");

    ob_end_flush();
?>