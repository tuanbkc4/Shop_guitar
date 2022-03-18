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
        <div class="container">
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
        <div class="container bg-white mt-5 p-0">
            <table class="table table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col" width="80px">STT</th>
                        <th scope="col">PRODUCT NAME</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">PRICE</th>
                        <th scope="col" width="200px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row" class="text-center">1</td>
                        <td>Mark</td>
                        <td class="text-center">
                            <span>food</span>
                        </td>
                        <td class="text-center">
                            <span>$123</span>                            
                        </td>
                        <td class="action_cat">
                            <a href="detail.php" class="edit">
                            <ion-icon name="eye-outline"></ion-icon>
                            </a>
                            <a href="edit.php" class="edit">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <a href="" class="del">
                                <ion-icon name="trash-outline"></ion-icon>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="p-2">
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
                </tbody>
            </table>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
    ?>