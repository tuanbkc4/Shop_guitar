<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/header.php';

$id = $_GET["id"];
if (is_numeric($id)) {
    $id = (int)$id;
    $qrGetInfo = "SELECT id FROM product WHERE id = {$id}";
    $resultGetInfo = $conn->query($qrGetInfo);
    if ($resultGetInfo->num_rows == 0) {
        header('location:index.php?msgDanger=Product không tồn tại');
        die();
    }
} else {
    header('location:index.php?msgDanger=Product không tồn tại');
    die();
}

// delete data images if exists
$queryCheckImages = "SELECT * FROM image WHERE product_id = {$id}";
$resultCheckImages = $conn->query($queryCheckImages);

if($resultCheckImages->num_rows > 0){
    // xoá file image
    while ($arInfoImage = $resultCheckImages->fetch_assoc()) {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/files/images/products/' . $arInfoImage['name']);
        $qrRemoveImage = "DELETE FROM image WHERE id = {$arInfoImage['id']}";
        $resultRemoveImage = $conn->query($qrRemoveImage);
    }
}

//delete data product
$qrRemove = "DELETE FROM product WHERE id= $id";
$resultRemove = $conn->query($qrRemove);
if ($resultRemove) {
    header('location:index.php?msgSuccess=Xoá thành công');
    die();
} else {
    header('location:index.php?msgDanger=Xoá thất bại');
    die();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
