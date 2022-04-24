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
                <h3 class="mb-3">User</h3>
            </div>
            <div class="row bg-white p-4 rounded-lg justify-content-between">
                <form class="col-md-9">
                    <div class="row justify-content-between">
                        <input class="col-12 w-full form-input" type="search" name="search" placeholder="Search by user...">
                        <button type="submit" class="d-none absolute right-0 top-0 mt-5 mr-1"></button>
                    </div>
                </form>
                <a class="col-md-2 btn-custom" href="add.php">Add User</a>
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
                        <th scope="col" width="250px">FULLNAME</th>
                        <th scope="col" width="200px">USERNAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col" width="150px">PHONE</th>
                        <th scope="col" width="150px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $queryGetUser = "SELECT * FROM user";
                    $result = $conn->query($queryGetUser);
                    $index = 1;
                    if ($result->num_rows > 0) {
                        while ($arUser = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td scope="row" class="text-center"><?php echo $index++ ?></td>
                                <td class="pl-4">
                                    <?php echo $arUser['fullname'] ?>
                                </td>
                                <td class="pl-4">
                                    <?php echo $arUser['username'] ?>
                                </td>
                                <td class="pl-4">
                                    <?php echo $arUser['email'] ?>
                                </td>
                                <?php
                                $getPhone = "SELECT phone FROM address WHERE user_id = {$arUser['id']} LIMIT 1";
                                $resultGetPhone = $conn->query($getPhone);
                                $phone =  $resultGetPhone->fetch_assoc();
                                ?>
                                <?php
                                if ($resultGetPhone->num_rows > 0) {
                                ?>
                                    <td class="text-center">
                                        <?php echo $phone['phone'] ?>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <td class="text-center">
                                    </td>
                                <?php
                                }
                                ?>
                                <td class="action_cat">
                                    <a href="edit.php?id=<?php echo $arUser['id'] ?>" class="edit">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </a>
                                    <a href="#" class="remove">
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
                                <p class="text-center mb-1 mt-1">Không có user</p>
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