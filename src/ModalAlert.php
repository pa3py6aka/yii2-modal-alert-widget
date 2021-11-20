<?php
/**
 * @copyright Copyright (c) Alexander Savelyev <http://weblancer.net/users/alexsava>
 * @license https://github.com/pa3py6aka/yii2-modal-alert-widget/blob/master/LICENSE.md
 * @link https://github.com/pa3py6aka/yii2-modal-alert-widget
 */

namespace pa3py6aka\yii2;

use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Widget;

/**
 * This widget show bootstrap modal or magnific popup when you set session flash message
 * For magnific popups you must install magnific js before using this widget - http://dimsemenov.com/plugins/magnific-popup/
 *
 * Example:
 * ----------
 * in controller set flash message:
 *     Yii::$app->session->setFlash('success', 'My Message');
 * or you can set flash this title:
 *     Yii::$app->session->setFlash('success', [['My title', 'My Message']]);
 *
 * In your layout view show this widget:
 *     <?= ModalAlertWidget::widget(['popupCssClass' => 'my-popup-class']) ?>
 *
 * That's all :)
 */
class ModalAlert extends Widget
{
    /* @deprecated Use TYPE_BOOTSTRAP_3 instead */
    const TYPE_BOOTSTRAP = 'bs3';

    /* Bootstrap 3 modal */
    const TYPE_BOOTSTRAP_3 = 'bs3';

    /* Bootstrap 4 modal (by default) */
    const TYPE_BOOTSTRAP_4 = 'bs4';

    /* Bootstrap 5 modal without jQuery */
    const TYPE_BOOTSTRAP_5 = 'bs5';

    /* Bootstrap 5 modal with jQuery enabled */
    const TYPE_BOOTSTRAP_5_JQUERY = 'bs5-jquery';

    /* Magnific popup modal */
    const TYPE_MAGNIFIC = 'magnific';

    /**
     * @var string Type of modal - bootstrap3,4 or magnific-popup
     */
    public $type = self::TYPE_BOOTSTRAP_4;

    /**
     * @var string CSS class for main popup block
     */
    public $popupCssClass = '';

    /**
     * @var string Id for main popup block
     */
    public $popupId = 'pa3py6aka-modal-alert';

    /**
     * @var string Magnific popup type
     */
    public $magnificPopupType = 'inline';

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
     * @var string Path to view for render popup, may be use aliases
     */
    public $popupView;

    /**
     * @var int Time in seconds after which the modal window will be automatically closed (0 means that modal will be closed only by user)
     */
    public $showTime = 0;

    public function init()
    {
        parent::init();

        if (!$this->type) {
            throw new InvalidArgumentException('Modal type is required');
        }

        $this->showTime = (int) $this->showTime * 1000;
    }

    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $messages = [];
        $show = false;
        $title = null;

        foreach ($flashes as $type => $data) {
            $cssClass = isset($this->alertTypes[$type]) ? $this->alertTypes[$type] : 'alert-info';
            $data = (array) $data;
            foreach ($data as $message) {
                if ($message) {
                    $show = true;
                }
                if (is_array($message)) {
                    if (count($message) > 1) {
                        $mTitle = array_shift($message);
                        $title = $title ?: $mTitle;
                    }
                    $message = array_shift($message);
                }
                $messages[] = [
                    'cssClass' => $cssClass,
                    'message' => $message,
                ];
            }

            $session->removeFlash($type);
        }

        if ($show) {
            $this->showModal();
            return $this->renderModal($messages, $title);
        }

        return '';
    }

    private function renderModal(array $messages, $title)
    {
        $path = $this->popupView ?: $this->type . '-modal';
        if ($this->type === self::TYPE_BOOTSTRAP_5_JQUERY && ! $this->popupView) {
            $path = self::TYPE_BOOTSTRAP_5 . '-modal';
        }

        return $this->render($path, [
            'messages' => $messages,
            'popupCssClass' => $this->popupCssClass,
            'popupId' => $this->popupId,
            'title' => $title,
        ]);
    }

    private function showModal()
    {
        // Bootstrap 3/4/5 with jQuery
        if (in_array($this->type, [self::TYPE_BOOTSTRAP, self::TYPE_BOOTSTRAP_3, self::TYPE_BOOTSTRAP_4, self::TYPE_BOOTSTRAP_5_JQUERY])) {
            $closeTimer = $this->showTime > 0 ? "setTimeout(\"$('#{$this->popupId}').modal('hide');\", {$this->showTime});" : '';
            $js = <<<JS
$('#{$this->popupId}').modal('show');
{$closeTimer}
JS;
        }

        // Bootstrap 5 without jQuery
        if ($this->type === self::TYPE_BOOTSTRAP_5) {
            $closeTimer = $this->showTime > 0 ? "setTimeout(\"alertModal.hide();\", {$this->showTime});" : '';
            $js = <<<JS
var alertModal = new bootstrap.Modal(document.getElementById('{$this->popupId}'));
alertModal.show();
{$closeTimer}
JS;
        }

        // Magnific popup
        if ($this->type === self::TYPE_MAGNIFIC) {
            $closeTimer = $this->showTime > 0 ? "setTimeout(\"$.magnificPopup.close();\", {$this->showTime});" : '';
            $js = <<<JS
$.magnificPopup.open({
    items: {
        src: '#{$this->popupId}',
        type: '{$this->magnificPopupType}',
        midClick: true
    }
});
{$closeTimer}
JS;
        }

        $this->view->registerJs($js);
    }
}
