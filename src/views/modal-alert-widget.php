<?php
/* @var $messages array */
/* @var $popupCssClass string */
/* @var $popupId string */

?>
<div id="<?= $popupId ?>" class="<?= $popupCssClass ?> mfp-hide" style="position:relative;">
<?php foreach ($messages as $message): ?>
    <p class="<?= $message['cssClass'] ?>"><?= $message['message'] ?></p>
<?php endforeach; ?>
</div>
