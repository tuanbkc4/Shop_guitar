<?php
    session_start();
    ob_start();

    unset($_SESSION['arUser']);
    header("location:{$_SESSION['back']}");

    ob_end_flush();
?>