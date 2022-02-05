Yii2 Modal Alert Widget
=======================

[![Latest Stable Version](https://img.shields.io/packagist/v/pa3py6aka/yii2-modal-alert-widget.svg)](https://packagist.org/packages/pa3py6aka/yii2-modal-alert-widget)
[![License](https://poser.pugx.org/pa3py6aka/yii2-modal-alert-widget/license)](https://packagist.org/packages/pa3py6aka/yii2-modal-alert-widget)
[![Total Downloads](https://poser.pugx.org/pa3py6aka/yii2-modal-alert-widget/downloads)](https://packagist.org/packages/pa3py6aka/yii2-modal-alert-widget)
[![Monthly Downloads](https://poser.pugx.org/pa3py6aka/yii2-modal-alert-widget/d/monthly)](https://packagist.org/packages/pa3py6aka/yii2-modal-alert-widget)
[![Daily Downloads](https://poser.pugx.org/pa3py6aka/yii2-modal-alert-widget/d/daily)](https://packagist.org/packages/pa3py6aka/yii2-modal-alert-widget)

This widget show bootstrap modal or magnific popup when you set session flash message.

Supports all bootstrap versions - 3,4 and 5.

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
"pa3py6aka/yii2-modal-alert-widget": "^1.4"
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
<?= ModalAlert::widget() ?>
```
By default widget using bootstrap 4 modal. Use `type` property to switch to another modal type:
```
<?p= ModalAlert::widget(['type' => ModalAlert::TYPE_BOOTSTRAP_5]) ?>
```
You can set flashes with titles:
```
Yii::$app->session->setFlash('error', [['My Title', 'My Message']]);
```
Available options
-----------------
`type` - Type of alert - bootstrap 3/4/5 jquery or magnific popup, defaults to bootstrap 4. 
         Bootstrap 5 type has two versions - with jQuery enabled and without jQuery.
         Use declared constants to set type (like `ModalAlert::TYPE_BOOTSTRAP_5_JQUERY`). 
         See available types in source code.

`popupCssClass` - CSS class for modal(popup).

`popupId` - Modal(popup) ID.

`magnificPopupType` - Type of magnific popup, defaults to _"inline"_. See available types in official magnific popup guide.

`popupView` - Path to your custom view for render modal(popup). You can copy original view from `vendor/pa3py6aka/yii2-modal-alert-widget/src/views` and customize it.

`showTime` - Time in seconds after which the modal window will be automatically closed (`0` means that modal will be closed only by user)

`modalSize` - Bootstrap Modal size, available size `modal-sm`, `modal-lg`, `modal-xl`, default to `''`

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
