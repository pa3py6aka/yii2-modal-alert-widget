Yii2 Modal Alert Widget
=======================

This widget show magnific popup when you set session flash message.

You must install magnific popup before using this widget - http://dimsemenov.com/plugins/magnific-popup/

Alerts for native bootstrap modals will added soon. And welcome to pull-requests.

Installation:
-------------
Install with composer:
```
composer require pa3py6aka/yii2-modal-alert-widget
```
or add
```
"pa3py6aka/yii2-modal-alert-widget": "*"
```
to the require section of your composer.json file.

Usage:
--------
In controller set flash message:
```
Yii::$app->session->setFlash('success', 'My Message');
```
In your layout view show this widget:
```
<?php use pa3py6aka\yii2\ModalAlertWidget; ?>
...
<?php echo ModalAlertWidget::widget(['popupCssClass' => 'my-popup-class(es)']) ?>
```
That's all :)

P.S.See available options in main class of widget.