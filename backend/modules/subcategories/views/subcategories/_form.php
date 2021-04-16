<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Subcategories */
/* @var $form yii\widgets\ActiveForm */
/* @var $dropDownCategories backend\modules\subcategories\controllers\SubcategoriesController */
/* @var $dropDownSubCategories backend\modules\subcategories\controllers\SubcategoriesController */
?>

<div class="subcategories-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput() ?>
	<?= $form->field($model, 'issetSubCategory')->dropDownList($dropDownSubCategories, ['prompt' => 'Пожалуйста, выберите значение']) ?>
	<?= $form->field($model, 'category')->dropDownList($dropDownCategories, ['prompt' => 'Пожалуйста, выберите значение']) ?>
    <div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
