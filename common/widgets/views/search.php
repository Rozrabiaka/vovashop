<?php

use yii\widgets\ActiveForm;
/* @var $model frontend\models\Search */
?>

<?php $form = ActiveForm::begin(['method' => 'get', 'action' => '/site/products']); ?>

<?= $form->field($model, 'q')->textInput(['maxlength' => true, 'placeholder' => 'Введите запрос'])->label(false) ?>

<?php ActiveForm::end(); ?>
