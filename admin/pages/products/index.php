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
                <h3 class="mb-3">Product</h3>
            </div>
            <div class="row bg-white p-4 rounded-lg justify-content-between">
                <form class="col-md-9">
                    <div class="row justify-content-between">
                        <input class="col-md-7 w-full form-input" type="search" name="search" placeholder="Search by product...">
                        <button type="submit" class="d-none absolute right-0 top-0 mt-5 mr-1"></button>
                        <select class="col-md-4 form-input">
                            <option value="All" hidden="">Category</option>
                            <option value="Fish &amp; Meat">Fish &amp; Meat</option>
                        </select>

                    </div>
                </form>
                <a class="col-md-2 btn-custom" href="add.php">Add Product</a>
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
                        <th scope="col">PRODUCT NAME</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">QUANTITY</th>
                        <th scope="col" width="200px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $queryGetProduct = "SELECT p.*,cat.name AS catName FROM product AS p INNER JOIN category AS cat ON p.category_id = cat.id ORDER BY p.id DESC";
                    $result = $conn->query($queryGetProduct);
                    $index = 1;
                    if ($result->num_rows > 0) {
                        while ($arProducts = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td scope="row" class="text-center"><?php echo $index++ ?></td>
                                <td class="pl-4">
                                    <?php echo $arProducts['name'] ?>
                                </td>
                                <td class="pl-4">
                                    <?php echo $arProducts['catName'] ?>
                                </td>
                                <td class="pl-4">
                                    <?php echo number_format($arProducts['price'], 0, '.', ',') ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $arProducts['quantity'] ?>
                                </td>
                                <td class="action_cat">
                                    <a href="detail.php?id=<?php echo $arProducts['id'] ?>" class="edit">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </a>
                                    <a href="edit.php?id=<?php echo $arProducts['id'] ?>" class="edit">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    <a href="remove.php?id=<?php echo $arProducts['id'] ?>" class="remove">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="6" class="p-2">
                                <div class="footer-table">
                                    <div>SHOWING 1-8 OF 18</div>
                                    <nav class="ml-auto">
                                        <ul class="pagination separated pagination-info">
                                            <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-left"></i></a></li>
                                            <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                                            <li class="page-item"><a href="#" class="page-link">4</a></li>
                                            <li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-right"></i></a></li>
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
                                <p class="text-center mb-1 mt-1">Không có sản phẩm</p>
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