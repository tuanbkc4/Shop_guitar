<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/timeAgo.php';

if (isset($_POST['parent_id'], $_POST['product_id'])) {
    $id = $_POST['product_id'];
    $parent_id = $_POST['parent_id'];
    // truy vấn
    $queryDelComment = "DELETE FROM comment WHERE id = {$parent_id} || parent_id = {$parent_id}";
    $resultDelComment = $conn->query($queryDelComment);
}
?>
<!-- respone -->
<ul id="comments-list" class="comments-list">
    <?php
    $queryGetComment = "SELECT c.*, u.fullname,u.avt,u.id AS u_id FROM comment AS c INNER JOIN user AS u ON c.user_id = u.id WHERE product_id = {$id} && parent_id IS NULL";
    $resultGetComment = $conn->query($queryGetComment);

    while ($arGetComment = $resultGetComment->fetch_assoc()) {
        $parent_id = $arGetComment['id'];
    ?>
        <li>
            <div class="comment-main-level">
                <!-- Avatar -->
                <div class="comment-avatar"><img src="/SHOP_GUITAR/files/images/avatar/<?php echo $arGetComment['avt']; ?>" alt=""></div>
                <!-- Contenedor del Comentario -->
                <div class="comment-box">
                    <div class="comment-head">
                        <div>
                            <h6 class="comment-name"><?php echo $arGetComment['fullname']; ?></h6>
                            <span><?php echo time_ago($arGetComment['created_at']); ?></span>
                        </div>
                        <div>
                            <button class="button-reply" name="<?php echo $id ?>,<?php echo $parent_id ?>"><i class="fa fa-reply"></i></button>
                            <?php
                            if (isset($_SESSION['arUser'])) {
                                if ($arGetComment['u_id'] == $_SESSION['arUser']['id']) {
                            ?>
                                    <i class="fa fa-ellipsis-v manage-comment" aria-hidden="true">
                                        <ul>
                                            <li><button class="edit-parent-comment" value="<?php echo $id; ?>,<?php echo $parent_id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit</button></li>
                                            <li><button class="remove-parent-comment" value="<?php echo $id; ?>,<?php echo $parent_id; ?>"><i class="fa fa-trash" aria-hidden="true"></i> remove</button></li>
                                        </ul>
                                    </i>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="comment-content">
                        <?php echo $arGetComment['content']; ?>
                    </div>
                </div>
            </div>
            <!-- Reply -->
            <ul class="comments-list reply-list reply-list-<?php echo $parent_id; ?>">
                <?php
                $queryGetSubComment = "SELECT c.*, u.fullname,u.avt,u.id AS u_id FROM comment AS c INNER JOIN user AS u ON c.user_id = u.id WHERE product_id = {$id} && parent_id = {$parent_id}";
                $resultGetSubComment = $conn->query($queryGetSubComment);
                while ($arGetSubComment = $resultGetSubComment->fetch_assoc()) {
                ?>
                    <li>
                        <!-- Avatar -->
                        <div class="comment-avatar"><img src="/SHOP_GUITAR/files/images/avatar/<?php echo $arGetSubComment['avt']; ?>" alt=""></div>
                        <!-- Contenedor del Comentario -->
                        <div class="comment-box">
                            <div class="comment-head">
                                <div>

                                    <h6 class="comment-name"><?php echo $arGetSubComment['fullname']; ?></h6>
                                    <span><?php echo time_ago($arGetSubComment['created_at']); ?></span>
                                </div>
                                <div>
                                    <button class="button-reply" name="<?php echo $id ?>,<?php echo $parent_id ?>"><i class="fa fa-reply"></i></button>
                                    <?php
                                    if (isset($_SESSION['arUser'])) {
                                        if ($arGetSubComment['u_id'] == $_SESSION['arUser']['id']) {
                                    ?>
                                            <i class="fa fa-ellipsis-v manage-comment" aria-hidden="true">
                                                <ul>
                                                    <li><button class="edit-sub-comment" value="<?php echo $id; ?>,<?php echo $parent_id; ?>,<?php echo $arGetSubComment['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit</button></li>
                                                    <li><button class="remove-sub-comment" value="<?php echo $id; ?>,<?php echo $parent_id; ?>,<?php echo $arGetSubComment['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i> remove</button></li>
                                                </ul>
                                            </i>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="comment-content">
                                <?php echo $arGetSubComment['content']; ?>
                            </div>
                        </div>
                    </li>
                <?php
                }
                ?>

                <?php
                if (isset($_SESSION['arUser'])) {
                ?>
                    <li class="d-none">
                        <div class="d-flex align-items-center form-main-comment">
                            <!-- Avatar -->
                            <div class="comment-avatar"><img src="/SHOP_GUITAR/files/images/avatar/<?php echo $_SESSION['arUser']['avt']; ?>" alt=""></div>
                            <form action="javascript:void(0)" method="POST">
                                <input type="text" class="comment-input reply-<?php echo $parent_id ?> " name="<?php echo $parent_id; ?>" placeholder="Viết bình luận...">
                                <input type="submit" class="reply-submit d-none" value="<?php echo $id; ?>,<?php echo $_SESSION['arUser']['id']; ?>,<?php echo $parent_id; ?>">
                            </form>
                        </div>
                    </li>
                <?php
                }
                ?>

            </ul>
        </li>
    <?php
    }
    ?>

    <?php
    if (isset($_SESSION['arUser'])) {
    ?>
        <li>
            <div class="d-flex align-items-center form-main-comment">
                <!-- Avatar -->
                <div class="comment-avatar"><img src="/SHOP_GUITAR/files/images/avatar/<?php echo $_SESSION['arUser']['avt']; ?>" alt=""></div>

                <form action="javascript:void(0)" method="POST">
                    <input type="text" class="comment-input comment-main" name="content-main" placeholder="Viết bình luận...">
                    <input type="submit" name="<?php echo $id; ?>,<?php echo $_SESSION['arUser']['id']; ?>" class="d-none comment-submit">
                </form>
            </div>
        </li>
    <?php
    }
    ?>
</ul>