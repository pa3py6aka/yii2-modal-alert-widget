<?php
/* @var $messages array */
/* @var $popupCssClass string */
/* @var $popupId string */

?>
<!-- Modal -->
<div class="modal fade <?= $popupCssClass ?>" id="<?= $popupId ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="<?= $popupId ?>" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--<h4 class="modal-title" id="myModalLabel">Modal title</h4>-->
            </div>
            <div class="modal-body">
                <?php foreach ($messages as $message): ?>
                    <p class="<?= $message['cssClass'] ?>"><?= $message['message'] ?></p>
                <?php endforeach; ?>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>-->
        </div>
    </div>
</div>