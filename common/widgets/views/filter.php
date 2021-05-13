<?php

use yii\widgets\ActiveForm;
use \yii\helpers\Html;

/* @var $model frontend\models\Search */
?>

<div class="row">
    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => '/site/products']); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'priceFrom')->textInput(['maxlength' => true])->label('Мин. цена') ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'priceTo')->textInput(['maxlength' => true])->label('Макс. цена') ?>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton('Поиск', ['class' => 'btn btn-sm btn-outline-dark btn-hover-primary search-price-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>