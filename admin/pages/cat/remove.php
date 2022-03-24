<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/header.php';

$id = $_GET["id"];
if (is_numeric($id)) {
    $id = (int)$id;
    $qrGetInfo = "SELECT id FROM category WHERE id = {$id}";
    $resultGetInfo = $conn->query($qrGetInfo);
    if ($resultGetInfo->num_rows == 0) {
        header('location:index.php?msgDanger=Category không tồn tại');
        die();
    }
} else {
    header('location:index.php?msgDanger=Category không tồn tại');
    die();
}

$qrRemove = "DELETE FROM category WHERE id= $id OR parent_id = $id";
$resultRemove = $conn->query($qrRemove);
if ($resultRemove) {
    header('location:index.php?msgSuccess=Xoá thành công');
    die();
} else {
    header('location:index.php?msgDanger=Xoá thất bại');
    die();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
