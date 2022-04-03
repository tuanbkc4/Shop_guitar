<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/SHOP_GUITAR/Util/timeAgo.php';


if (isset($_POST['product_id'], $_POST['user_id'], $_POST['content'], $_POST['parent_id'])) {
    $id = (int)$_POST['product_id'];
    $user_id = (int)$_POST['user_id'];
    $content = $_POST['content'];
    $parent_id = (int)$_POST['parent_id'];

    // truy vấn

    $querySubComment = "INSERT INTO comment(content,product_id,user_id,parent_id) VALUES ('{$content}',{$id},{$user_id},{$parent_id})";
    $resultSubComment = $conn->query($querySubComment);
}
?>
<!-- respone -->
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