<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/header.php';
?>
<!-- side bar -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/sidebar.php';
?>
<!-- main -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container add_form">
            <div class="row">
                <section class="panel panel-default col-md-8 offset-md-2">
                    <div class="panel-heading">
                        <h3 class="panel-title mb-3">Edit Order status</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        // check order
                        $id = $_GET["id"];
                        if (is_numeric($id)) {
                            $id = (int)$id;
                            $qrGetInfo = "SELECT id,status FROM orders WHERE id = {$id}";
                            $resultGetInfo = $conn->query($qrGetInfo);

                            if ($resultGetInfo->num_rows == 0) {
                                return header('location:index.php?msgDanger=Order không tồn tại');
                                die();
                            }
                        } else {
                            return header('location:index.php?msgDanger=Order không tồn tại');
                            die();
                        }
                        $arInfo = $resultGetInfo->fetch_assoc();
                        $currentStauts = (int)$arInfo['status'];
                        $statusErr = "";
                        if (isset($_POST['submit'])) {
                            $status =  (int)$_POST['status'];
                            //  check
                            if ($status != $currentStauts) {
                                if ($status == 4 && !($currentStauts == 0 || $currentStauts == 2)) {
                                    $statusErr = "Bạn không thể hủy đơn hàng";
                                } elseif ($currentStauts == 4 || $currentStauts == 3) {
                                    $statusErr = "Bạn không thể thay đổi trạng thái đơn hàng";
                                }
                            }

                            if ($statusErr == "") {
                                $queryChange = "UPDATE orders SET status = {$status} WHERE id = {$id}";
                                $result = $conn->query($queryChange);
                                if($result){
                                    header('location:index.php?msgSuccess=Thay đổi thành công');
                                    die();
                                }
                            }
                        }
                        ?>
                        <form method="POST">
                            <select name="status" class="select mb-0">
                                <option value="0" <?php echo ($currentStauts  == 0 ? "selected" : ""); ?>>To Pay</option>
                                <option value="1" <?php echo ($currentStauts  == 1 ? "selected" : ""); ?>>To Ship</option>
                                <option value="2" <?php echo ($currentStauts  == 2 ? "selected" : ""); ?>>To Receive</option>
                                <option value="3" <?php echo ($currentStauts  == 3 ? "selected" : ""); ?>>Completed</option>
                                <option value="4" <?php echo ($currentStauts  == 4 ? "selected" : ""); ?>>Cancelled</option>
                            </select>
                            <?php
                            if ($statusErr != "") {
                            ?>
                                <span class="error"><?php echo $statusErr; ?></span>
                            <?php
                            }
                            ?>
                            <div class="text-right mt-2">
                                <a href="index.php">Back</a>
                                <input type="submit" value="save" name="submit">
                            </div>
                        </form>
                        <style>
                            .select {
                                width: 100%;
                                border-radius: 5px;
                                border: 1px solid #ccc;
                                padding: 4px 8px;
                                margin-bottom: 16px;
                            }

                            form input[type="submit"],
                            form a {
                                display: inline-block;
                                padding: 6px 12px;
                                margin-left: auto;
                                color: #fff;
                                border: 1px solid #ccc;
                                border-radius: 5px;
                                background-color: green;
                                cursor: pointer;
                            }

                            form a {
                                background-color: orange;
                            }

                            form a:hover {
                                background-color: #ffc046;
                                cursor: pointer;
                                color: #fff;
                            }

                            form input[type="submit"]:hover {
                                background-color: #4caf50;
                            }
                        </style>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
    ?>