<ul>
    <?php
    $queryCatParent = "SELECT * FROM category WHERE parent_id IS NULL";
    $resultCatParent = $conn->query($queryCatParent);
    while ($CatParent = $resultCatParent->fetch_assoc()) {
    ?>
        <li>
            <a data-toggle="collapse" href="#id-<?php echo $CatParent['id'] ?>" aria-expanded="false" aria-controls="id-<?php echo $CatParent['id'] ?>">
                <span class="menu-title"><?php echo $CatParent['name'] ?></span>
            </a>
            <div class="collapse" id="id-<?php echo $CatParent['id'] ?>">
                <ul class="border-0 pt-0 pb-0 pr-0 pl-4">
                    <?php
                    $queryCatChild = "SELECT * FROM category WHERE parent_id = {$CatParent['id']}";
                    $resultCatChild = $conn->query($queryCatChild);
                    while ($CatChild = $resultCatChild->fetch_assoc()) {
                    ?>
                        <li> <a href="cat.php?id=<?php echo $CatChild['id'] ?>"><?php echo $CatChild['name'] ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </li>
    <?php
    }
    ?>
</ul>