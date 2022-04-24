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
        <div class="container mb-5">
            <div class="row">
                <h3 class="mb-3">Contact</h3>
            </div>
            <div class="row bg-white p-4 rounded-lg justify-content-between">
                <form class="col-md-9">
                    <div class="row justify-content-between">
                        <input class="col-md-12 w-full form-input" type="search" name="search" placeholder="Search by contact...">
                        <button type="submit" class="d-none absolute right-0 top-0 mt-5 mr-1"></button>
                    </div>
                </form>
                <a class="col-md-2 btn-custom" href="add.php">Search</a>
            </div>
        </div>
        <div class="container p-0">
            <?php
            if (isset($_GET['msgSuccess'])) {
                $msgSuccess = $_GET['msgSuccess'];
            ?>
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    <strong><?php echo $msgSuccess; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <?php
            }
            ?>

            <?php
            if (isset($_GET['msgDanger'])) {
                $msgDanger = $_GET['msgDanger'];
            ?>
                <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                    <strong><?php echo $msgDanger; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            <?php
            }
            ?>
        </div>
        <div class="container bg-white p-0">

            <table class="table table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col" width="80px">STT</th>
                        <th scope="col" width="250px">NAME</th>
                        <th scope="col" width="250px">EMAIL</th>
                        <th scope="col">CONTENT</th>
                        <th scope="col" width="200px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <!--start pagination -->
                    <?php
                    //Tổng số dòng
                    $qrTsd = "SELECT * FROM contact";
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
                    $queryGetContact = "SELECT * FROM contact ORDER BY id DESC LIMIT {$offset},{$row_count}";
                    $result = $conn->query($queryGetContact);
                    $index = 1;
                    if ($result->num_rows > 0) {
                        while ($arContact = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td scope="row" class="text-center"><?php echo $index++ ?></td>
                                <td class="pl-4">
                                    <?php echo $arContact['name'] ?>
                                </td>
                                <td class="pl-4">
                                    <?php echo $arContact['email'] ?>
                                </td>
                                <td class="pl-4">
                                    <?php echo sub_str($arContact['content'], 50); ?>
                                </td>
                                <td class="action_cat">
                                    <?php
                                    $contact_id = $arContact['id'];
                                    include $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/admin/pages/contact/detail.php';
                                    ?>
                                    <a href="remove.php?id=<?php echo $contact_id; ?>" class="edit">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="7" class="p-2">
                                <div class="footer-table">
                                <div>SHOWING <?php echo $offset + 1; ?>-<?php echo ($current_page == $Tst ? $Tsd : $offset + $row_count); ?> OF <?php echo $Tsd; ?></div>
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
                            </td>
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr>
                            <td colspan="6" class="p-2">
                                <p class="text-center mb-1 mt-1">Không có liên hệ</p>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <script>
        var arRemove = document.querySelectorAll('.remove');
        arRemove.forEach(function(item) {
            item.onclick = function() {
                confirm('Bạn có chắc chắn muốn xoá không !!!')
            }
        });
    </script>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
    ?>