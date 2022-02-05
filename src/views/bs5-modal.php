<?php

/* @var $title string|null */
/* @var $messages array */
/* @var $popupCssClass string */
/* @var $popupId string */
?>
<!-- Alert Modal -->
<div class="modal fade <?= $popupCssClass ?>" id="<?= $popupId ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog <?= $modalSize ?>">
        <div class="modal-content">
            <div class="modal-header <?= $messages[0]['cssClass'] ?>">
                <h5 class="modal-title" id="myModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php foreach ($messages as $message): ?>
                    <p><?= $message['message'] ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
