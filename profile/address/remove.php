<!-- header -->
<?php
session_start();
ob_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/checkUser.php';

//   find address
$id = $_GET["id"];
if (is_numeric($id)) {
    $id = (int)$id;
    $qrGetInfo = "SELECT * FROM address WHERE id = {$id}";
    $resultGetInfo = $conn->query($qrGetInfo);
    if ($resultGetInfo->num_rows == 0) {
        header('location:index.php?msgDanger=Address không tồn tại');
        die();
    } else {
        $Address = $resultGetInfo->fetch_assoc();
    }
} else {
    header('location:index.php?msgDanger=Address không tồn tại');
    die();
}

if((boolean)$Address['is_default']){
    // set defaut address
    $query = "UPDATE address SET is_default = 1 WHERE id = (SELECT id FROM address WHERE id != {$id} LIMIT 1)";
    $result = $conn->query($query);
}
    $qrRemoveAddess = "DELETE FROM address WHERE id = {$id}";
    $resultRemoveAddess = $conn->query($qrRemoveAddess);
    if ($resultRemoveAddess) {
        $_SESSION['removeAddress'] = true;
        header('location:index.php');
        die();
    }
ob_end_flush();
?>