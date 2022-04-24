<!-- header -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/header.php';
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/sidebar.php';
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <!-- Quick Action Toolbar Starts-->
        <div class="row quick-action-toolbar">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header d-block d-md-flex">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="d-md-flex row m-0 quick-action-btns" role="group" aria-label="Quick action buttons">
                        <div class="col-sm-12 col-md-4 p-3 text-center btn-wrapper">
                            <a href="/SHOP_GUITAR/admin/pages/user/add.php">
                                <button type="button" class="btn px-0"> <i class="icon-user mr-2"></i> Add User</button>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-4 p-3 text-center btn-wrapper">
                            <a href="/SHOP_GUITAR/admin/pages/products/add.php">
                                <button type="button" class="btn px-0"><i class="icon-docs mr-2"></i> Add Product</button>
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-4 p-3 text-center btn-wrapper">
                            <a href="/SHOP_GUITAR/admin/pages/cat/add.php"><button type="button" class="btn px-0"><i class="icon-folder mr-2"></i> Add Category</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick Action Toolbar Ends-->
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-sm-flex align-items-baseline report-summary-header">
                                    <h5 class="font-weight-semibold">Report Summary</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row report-inner-cards-wrapper">
                            <?php
                            $getUser = "SELECT id FROM USER";
                            $resultUser = $conn->query($getUser);
                            ?>
                            <div class=" col-md -6 col-xl report-inner-card">
                                <div class="inner-card-text">
                                    <span class="report-title">USERS</span>
                                    <h4><?php echo $resultUser->num_rows; ?></h4>
                                </div>
                                <div class="inner-card-icon bg-success">
                                    <i class="icon-rocket"></i>
                                </div>
                            </div>
                            <?php
                            $getProduct = "SELECT id FROM product";
                            $resultProduct = $conn->query($getProduct);
                            ?>
                            <div class="col-md-6 col-xl report-inner-card">
                                <div class="inner-card-text">
                                    <span class="report-title">PRODUCT</span>
                                    <h4><?php echo $resultProduct->num_rows; ?></h4>
                                </div>
                                <div class="inner-card-icon bg-danger">
                                    <i class="icon-briefcase"></i>
                                </div>
                            </div>
                            <?php
                            $getOrder = "SELECT id FROM orders";
                            $resultOrder = $conn->query($getOrder);
                            ?>
                            <div class="col-md-6 col-xl report-inner-card">
                                <div class="inner-card-text">
                                    <span class="report-title">ORDER</span>
                                    <h4><?php echo $resultOrder->num_rows; ?></h4>
                                </div>
                                <div class="inner-card-icon bg-primary">
                                    <i class="icon-diamond"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center mb-4">
                            <h4 class="card-title mb-sm-0">Order confirm</h4>
                            <a href="/SHOP_GUITAR/admin/pages/order/" class="text-dark ml-auto mb-3 mb-sm-0"> View all Orders</a>
                        </div>
                        <div class="table-responsive border rounded p-1">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">User</th>
                                        <th class="font-weight-bold">Total Price</th>
                                        <th class="font-weight-bold">Payment</th>
                                        <th class="font-weight-bold">Created at</th>
                                        <th class="font-weight-bold">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--start pagination -->
                                    <?php
                                    //Tổng số dòng
                                    $qrTsd = "SELECT * FROM orders WHERE status = 0";
                                    $resultTsd = $conn->query($qrTsd);
                                    $Tsd = $resultTsd->num_rows;
                                    //Số item trong 1 trang 
                                    $row_count = ROW_COUNT;
                                    //Tổng số trang
                                    $Tst = ceil($Tsd / $row_count);
                                    //Trang hiện tại
                                    $current_page = 1;
                                    if (isset($_GET['page'])) {
                                        $current_page = $_GET['page'];
                                    }
                                    //offset
                                    $offset = ($current_page - 1) * $row_count;
                                    ?>
                                    <!--end pagination -->
                                    <?php
                                    $getListOrderConfirm = "SELECT user.*, orders.*,payment.* FROM orders INNER JOIN user ON orders.user_id = user.id INNER JOIN payment ON orders.payment_id = payment.id WHERE status = 0 LIMIT {$offset},{$row_count}";
                                    $resultListOrderConfirm = $conn->query($getListOrderConfirm);
                                    if ($resultListOrderConfirm->num_rows > 0) {
                                        while ($row = $resultListOrderConfirm->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    if ($row['avt'] != null) {
                                                    ?>
                                                        <img class="img-sm rounded-circle" src="/SHOP_GUITAR/files/images/avatar/<?php echo $row['avt']; ?>" alt="profile image"> <?php echo $row['fullname']; ?>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img class="img-sm rounded-circle" src="/SHOP_GUITAR/files/images/avatar/default.jpg" alt="profile image"> <?php echo $row['fullname']; ?>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo number_format($row['total_price'], 0, '.', ',') ?> đ</td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['created_at']; ?></td>
                                                <td>
                                                    <div class="badge badge-success p-2"><?php echo checkStatus($row['status']); ?></div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Không có đơn hàng cần xác nhận</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex mt-4 flex-wrap">
                            <p class="text-muted">Showing <?php echo $offset + 1; ?> to <?php echo ($current_page == $Tst ? $Tsd : $offset + $row_count); ?> of <?php echo $Tsd; ?> entries</p>
                            <nav class="ml-auto">
                                <ul class="pagination separated pagination-info">
                                    <?php
                                    if ($current_page > 1) {
                                        $pre_page = $current_page - 1;
                                    ?>
                                        <li class="page-item"><a href="?page=<?php echo $pre_page; ?>" class="page-link"><i class="icon-arrow-left"></i></a></li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item"><span class="page-link"><i class="icon-arrow-left"></i></span></li>
                                    <?php
                                    }
                                    if ($current_page > 2) {
                                    ?>
                                        <li class="page-item"><span class="page-link">...</span></li>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    for ($i = 1; $i <= $Tst; $i++) {
                                        if ($i != $current_page) {
                                            if ($i > $current_page - 2 && $i < $current_page + 2) {
                                    ?>
                                                <li class="page-item"><a href="?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <li class="page-item active"><a href="?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>

                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    if ($Tst - $current_page > 1) {
                                    ?>
                                        <li class="page-item"><span class="page-link">...</span></li>
                                    <?php
                                    }

                                    if ($current_page < $Tst) {
                                        $next_page = $current_page + 1;
                                    ?>
                                        <li class="page-item"><a href="?page=<?php echo $next_page; ?>" class="page-link"><i class="icon-arrow-right"></i></a></li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item"><span class="page-link"><i class="icon-arrow-right"></i></span></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
    ?>