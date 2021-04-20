<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RelationsCategory */
/* @var $checkboxArray backend\modules\relationscategory\controllers\RelationscategoryController */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relations-category-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'checkbox')->checkboxList($checkboxArray); ?>

    <div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
