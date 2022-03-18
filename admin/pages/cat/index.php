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
                <h3 class="mb-3">Category</h3>
            </div>
            <div class="row bg-white p-4 rounded-lg justify-content-between">
                <form class="col-md-9">
                    <div class="row justify-content-between">
                        <input class="col-md-7 w-full form-input" type="search" name="search" placeholder="Search by category type">
                        <button type="submit" class="d-none absolute right-0 top-0 mt-5 mr-1"></button>
                        <select class="col-md-4 form-input">
                            <option value="All" hidden="">Category</option>
                            <option value="Fish &amp; Meat">Fish &amp; Meat</option>
                        </select>

                    </div>
                </form>
                <a class="col-md-2 btn-custom" href="add.php">Add Category</a>
            </div>
        </div>
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

        <div class="container bg-white p-0">

            <table class="table table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col" width="80px">STT</th>
                        <th scope="col">PARENT</th>
                        <th scope="col">CHILDREN</th>
                        <th scope="col" width="200px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qr = "SELECT id,name FROM category WHERE parent_id IS NULL ";
                    $result = $conn->query($qr);
                    $index = 1;
                    if ($result->num_rows > 0) {
                        while ($arCats = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td scope="row" class="text-center"><?php echo $index++; ?></td>
                                <td><?php echo $arCats['name']; ?></td>
                                <?php
                                $qr1 = "SELECT id,name FROM category WHERE parent_id = {$arCats['id']}";
                                $resultChild = $conn->query($qr1);
                                if ($resultChild->num_rows > 0) {
                                ?>
                                    <td class="children_cat">
                                        <?php
                                        while ($arChild = $resultChild->fetch_assoc()) {
                                        ?>
                                            <span>
                                                <?php echo $arChild['name']; ?>
                                                <a href="edit.php?id=<?php echo $arChild['id']; ?>" class="edit">
                                                    <ion-icon name="create-outline"></ion-icon>
                                                </a>
                                                <a href="remove.php?id=<?php echo $arChild['id']; ?>" class="remove">
                                                    <ion-icon name="trash-outline"></ion-icon>
                                                </a>
                                            </span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <td></td>
                                <?php
                                }
                                ?>

                                <td class="action_cat">
                                    <a href="edit.php?id=<?php echo $arCats['id']; ?>" class="edit">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    <a href="remove.php?id=<?php echo $arCats['id']; ?>" class="remove">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="4" class="p-2">
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
                            <td colspan="4" class="p-2">
                                <p class="text-center mb-1 mt-1">Danh mục trống</p>
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
        var arRemove=document.querySelectorAll('.remove');
        console.log(arRemove);
        arRemove.forEach(function(item){
            item.onclick = function() {
                confirm('Bạn có chắc chắn muốn xoá không !!!')
            }
        });
    </script>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
    ?>