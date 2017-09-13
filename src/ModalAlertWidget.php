<?php
/**
 * This file is part of the pa3py6aka/yii2-modal-alert-widget library
 *
 * @copyright Copyright (c) Alexander Savelyev <http://weblancer.net/users/alexsava>
 * @license https://github.com/pa3py6aka/yii2-modal-alert-widget/blob/master/LICENSE.md
 * @link https://github.com/pa3py6aka/yii2-modal-alert-widget
 */

namespace pa3py6aka\yii2;

use Yii;
use yii\bootstrap\Widget;

/**
 * This widget show magnific popup when you set session flash message
 * You must install magnific popup before using this widget - http://dimsemenov.com/plugins/magnific-popup/
 *
 * Example:
 * ----------
 * in controller set flash message:
 *     Yii::$app->session->setFlash('success', 'My Message');
 *
 * In your layout view show this widget:
 *     <?= ModalAlert::widget(['popupCssClass' => 'my-popup-class(es)']) ?>
 *
 * That's all :)
 */
class ModalAlertWidget extends Widget
{
    /**
     * @var string CSS class for main popup block
     */
    public $popupCssClass = "";

    /**
     * @var string Id for main popup block
     */
    public $popupId = "pa3py6aka-modal-alert";

    /**
     * @var string Magnific popup type
     */
    public $magnificPopupType = "inline";

    /**
     * @var array List of CSS classes for flash-types
     */
    public $alertTypes = [
        'error'   => 'alert-danger',
        'danger'  => 'alert-danger',
        'success' => 'alert-success',
        'info'    => 'alert-info',
        'warning' => 'alert-warning'
    ];

    /**
     * @var string View path for render popup.
     */
    public $alertViewPath = "modal-alert-widget";

    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $messages = [];
        $show = false;

        foreach ($flashes as $type => $data) {
            $cssClass = isset($this->alertTypes[$type]) ? $this->alertTypes[$type] : 'alert-info';
            $data = (array) $data;
            foreach ($data as $message) {
                if ($message) {
                    $show = true;
                }
                $messages[] = [
                    'cssClass' => $cssClass,
                    'message' => $message
                ];
            }

            $session->removeFlash($type);
        }

        if ($show) {
            echo $this->renderModal($messages);
            $this->showModal();
        }
    }

    private function renderModal(array $messages)
    {
        return $this->render($this->alertViewPath, [
            'messages' => $messages,
            'popupCssClass' => $this->popupCssClass,
            'popupId' => $this->popupId
        ]);
    }

    private function showModal()
    {
        $js = <<<JS
$.magnificPopup.open({
    items: {
        src: '#{$this->popupId}',
        type: '{$this->magnificPopupType}',
        midClick: true
    }
});
JS;
        $this->view->registerJs($js);
    }
}