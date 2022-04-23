<a href="javascript:void(0)" class="edit btn-show-<?php echo $contact_id; ?>">
    <ion-icon name="eye-outline"></ion-icon>
</a>
<div class="modal modal-show-<?php echo $contact_id; ?>">
    <div class="modal-content text-left" style="overflow:hidden">
        <span class="close text-right">&times;</span>
        <div class="container">
            <p>Name: <?php echo $arContact['name']; ?></p>
            <p>Email: <?php echo $arContact['email']; ?></p>
            <p>Content: </p>
            <textarea cols="80" rows="20"><?php echo $arContact['content']; ?></textarea>
        </div>

    </div>
</div>




<link rel="stylesheet" href="/SHOP_GUITAR/templates/admin/assets/css/modal.css">
<script src="/SHOP_GUITAR/templates/shop/assets/js/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {
        var modal = $('.modal-show-<?php echo $contact_id; ?>');
        var btn = $('.btn-show-<?php echo $contact_id; ?>');
        var span = $('.close');

        btn.click(function() {
            modal.show();
        });

        span.click(function() {
            modal.hide();
        });

        $(window).on('click', function(e) {
            if ($(e.target).is('modal-show-<?php echo $contact_id; ?>')) {
                modal.hide();
            }
        });
    });
</script>