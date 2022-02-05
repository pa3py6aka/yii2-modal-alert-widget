<?php

/* @var $title string|null */
/* @var $messages array */
/* @var $popupCssClass string */
/* @var $popupId string */
?>
<!-- Alert Modal -->
<div class="modal fade <?= $popupCssClass ?>" id="<?= $popupId ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog <?= $modalSize ?>" role="document">
        <div class="modal-content">
            <div class="modal-header <?= $messages[0]['cssClass'] ?>">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php if ($title): ?>
                    <h4 class="modal-title" id="myModalLabel"><?= $title ?></h4>
                <?php endif; ?>
            </div>
            <div class="modal-body">
                <?php foreach ($messages as $message): ?>
                    <p><?= $message['message'] ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
