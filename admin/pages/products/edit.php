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
                        <h3 class="panel-title mb-3">Edit Product</h3>
                    </div>
                    <div class="panel-body">

                        <form action="#" method="POST" class="form-horizontal" role="form" multipart="from-data">
                            <div class="form-group">
                                <label for="name_product">Product Name</label>
                                <input type="text" name="name_product" class="form-control" id="name_product" placeholder="Prodcut Name">
                            </div>
                            <div class="form-group">
                                <label for="Category">Product Category</label>
                                <select class="form-control" name="product_category" id="Category">
                                    <option vlaue="">-- Choose product category --</option>
                                    <option vlaue="1">1</option>
                                    <option vlaue="1">1</option>
                                    <option vlaue="1">1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Quantity">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="Quantity" placeholder="Quantity">
                            </div>
                            <div class="form-group">
                                <label for="Prodcut_description">Prodcut description</label>
                                <textarea rows="6" type="number" name="Prodcut_description" class="form-control" id="Prodcut_description" placeholder="Prodcut description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="file[]" class="form-control" id="image" multiple>
                            </div>
                            <input type="submit" value="Upload product" name="submit" class="btn btn-success">
                            <a class="btn btn-warning" href="index.php">Back</a>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/templates/admin/inc/footer.php';
    ?>