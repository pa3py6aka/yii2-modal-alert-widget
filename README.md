Yii2 Modal Alert Widget
=======================

[![License](https://poser.pugx.org/pa3py6aka/yii2-modal-alert-widget/license)](https://packagist.org/packages/pa3py6aka/yii2-modal-alert-widget)
[![Total Downloads](https://poser.pugx.org/pa3py6aka/yii2-modal-alert-widget/downloads)](https://packagist.org/packages/pa3py6aka/yii2-modal-alert-widgetr)
[![Monthly Downloads](https://poser.pugx.org/pa3py6aka/yii2-modal-alert-widget/d/monthly)](https://packagist.org/packages/pa3py6aka/yii2-modal-alert-widget)
[![Daily Downloads](https://poser.pugx.org/pa3py6aka/yii2-modal-alert-widget/d/daily)](https://packagist.org/packages/pa3py6aka/yii2-modal-alert-widgetr)

This widget show bootstrap modal or magnific popup when you set session flash message.

For magnific popups you must install magnific js before using this widget - http://dimsemenov.com/plugins/magnific-popup/

And for bootstrap modals of course you must set up bootstrap in your project.

Installation
------------
Install with composer:
```
composer require pa3py6aka/yii2-modal-alert-widget
```
or add
```
"pa3py6aka/yii2-modal-alert-widget": "*"
```
to the require section of your composer.json file.

Usage
-----
In controller set flash message:
```
Yii::$app->session->setFlash('success', 'My Message');
```
In your layout view show this widget:
```
<?php use pa3py6aka\yii2\ModalAlert; ?>
...
<?php echo ModalAlert::widget() ?>
```
For magnific popup:
```
<?php echo ModalAlert::widget(['type' => ModalAlert::TYPE_MAGNIFIC]) ?>
```
You can set flashes with titles:
```
Yii::$app->session->setFlash('error', [['My Title', 'My Message']]);
```
Available options
-----------------
`type` - Type of alert - bootstrap modal or magnific popup, defaults to bootstrap.

`popupCssClass` - CSS class for modal(popup).

`popupId` - Modal(popup) ID.

`magnificPopupType` - Type of magnific popup, defaults to _"inline"_. See available types in official magnific popup guide.

`popupView` - Path to your custom view for render modal(popup). You can copy original view from `vendor/pa3py6aka/yii2-modal-alert-widget/src/views` and customize it.

Example
-------
```
<?= ModalAlert::widget([
    'popupCssClass' => 'my-custom-class',
    'popupView' => '@app/views/common/my-custom-alert',
]) ?>
```
Then, set flash:
```
Yii::$app->session->setFlash('error', [['Terrible mistake!', "Sorry, you can't sign up, because your karma is very small"]]);
```
And we get:
![Alt text](http://res.cloudinary.com/pa3py6aka/image/upload/v1510873911/example-screen_dzqvko.png "Example modal")