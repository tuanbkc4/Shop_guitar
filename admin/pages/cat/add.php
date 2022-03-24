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
                        <h3 class="panel-title mb-3">Add Category</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $name = "";
                        $nameErr = "";
                        $checked = "";
                        $parentCat = "";
                        $parentCatErr = "";
                        if (isset($_POST['submit'])) {
                            $name = trim($_POST['cat_name']);
                            $parentCat = $_POST['Parent_Category'];

                            if (isset($_POST['checkbox'])) {
                                $checked = "checked";
                                if ($parentCat == "") {
                                    $parentCatErr = "Vui lòng chọn parent category ";
                                }
                            }

                            if ($name == "") {
                                $nameErr = "Vui lòng nhập tên danh mục";
                            } else {
                                $qrCheckCatName = "SELECT * FROM category WHERE name = '$name'";
                                $resultCheck = $conn->query($qrCheckCatName);
                                if ($resultCheck->num_rows > 0) {
                                    $nameErr = "Tên danh mục đã tồn tại";
                                }
                            }



                            if ($nameErr == "" && $parentCatErr == "") {
                                if (isset($_POST['checkbox'])) {
                                    $qrInsert = "INSERT INTO category(name,parent_id) VALUES ('$name',$parentCat)";
                                    $result = $conn->query($qrInsert);
                                    if ($result) {
                                        header('location:index.php?msgSuccess=Thêm thành công');
                                        die();
                                    } else {
                                        header('location:index.php?msgDanger=Thêm thất bại');
                                        die();
                                    }
                                } else {
                                    $qrInsert = "INSERT INTO category(name) VALUES ('$name')";
                                    $result = $conn->query($qrInsert);
                                    if ($result) {
                                        header('location:index.php?msgSuccess=Thêm thành công');
                                        die();
                                    } else {
                                        header('location:index.php?msgDanger=Thêm thất bại');
                                        die();
                                    }
                                }
                            }
                        }
                        ?>
                        <form method="POST" action="" class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="cat_name">Category Name</label>
                                <input type="text" class="form-control form-input" id="cat_name" placeholder="Category Name" name="cat_name" value="<?php echo ($name != "" ? $name : ""); ?>">
                                <?php
                                if ($nameErr != "") {
                                ?>
                                    <span class="error"><?php echo $nameErr; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="checkbox">Child Category</label>
                                <input type="checkbox" name="checkbox" id="checkbox" <?php echo $checked; ?> class="checked_child_cat">
                            </div>
                            <div class="form-group parent_cat mt-1" style="display:<?php echo ($checked != "" ? "block" : "none") ?>;">
                                <label for="Parent Category">Parent Category</label>
                                <select name="Parent_Category" class="form-control form-input" id="Parent_Category">
                                    <option value="">-- Choose parent --</option>
                                    <?php
                                    $querySelect = "SELECT id,name FROM category WHERE parent_id IS NULL";
                                    $resultSelect = $conn->query($querySelect);
                                    while ($arSelect = $resultSelect->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $arSelect['id']; ?>"><?php echo $arSelect['name'];  ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?php
                                if ($parentCatErr != "") {
                                ?>
                                    <span class="error"><?php echo $parentCatErr; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success btn-md">Add Category</button>
                            <a class="btn btn-warning" href="index.php">Back</a>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        var checked_child_cat = document.querySelector('.checked_child_cat');
        var parent_cat = document.querySelector('.parent_cat');
        checked_child_cat.onclick = function() {
            if (checked_child_cat.checked) {
                parent_cat.style.display = "block";
            } else {
                parent_cat.style.display = "none";
            }
        }
    </script>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
    ?>