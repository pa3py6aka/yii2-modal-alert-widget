Upgrade from version 1.3.2
-----------------------

* By default, the widget now uses bs4 modal. If you are  using bootstrap 3 in your project, you must manually set type of modalAlert to `bs3`: 
  ```php
  ModalAlert::widget(['type' => ModalAlert::TYPE_BOOTSTRAP_3]);
  ```
