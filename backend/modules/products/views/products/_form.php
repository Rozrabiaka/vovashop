<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Products */
/* @var $productsImage backend\models\ProductsImage */
/* @var $form yii\widgets\ActiveForm */
/* @var $allCategories backend\modules\marks\controllers\MarksController */
/* @var $allMarks backend\modules\marks\controllers\MarksController */
/* @var $productStatus backend\modules\products\controllers\ProductsController */
/* @var $productColors backend\modules\products\controllers\ProductsController */
?>

<div class="products-form">

	<?php $form = ActiveForm::begin([
		'options' => ['enctype' => 'multipart/form-data'] // important
	]); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'category_id')->dropDownList($allCategories, ['prompt' => 'Пожалуйста, выберите значение']) ?>

	<?= $form->field($model, 'subcategory_id')->dropDownList(['prompt' => 'Пожалуйста, выберите категорию']) ?>

	<?= $form->field($model, 'model')->dropDownList($allMarks, ['prompt' => 'Пожалуйста, выберите значение']) ?>

	<?= $form->field($model, 'color')->dropDownList($productColors, ['prompt' => 'Пожалуйста, выберите цвет']) ?>

	<?= $form->field($model, 'price')->textInput() ?>

	<?= $form->field($model, 'dollar_price')->textInput() ?>

	<?= $form->field($model, 'qty')->textInput() ?>

    <span style="color:red;">ВАЖНО!</span> Если Вы выбрали статус как "неактивен", то продукт не будет отбражаться на
    сайте в продаже
	<?= $form->field($model, 'product_status')->dropDownList($productStatus) ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'image[]')->widget(FileInput::classname(), [
		'pluginOptions' => [
			'showUpload' => false,
			'overwriteInitial' => true,
			'allowedFileExtensions' => ['jpg', 'png', 'jpeg'],
			'maxFileSize' => 2800
		],
		'options' => ['multiple' => true, 'accept' => 'image/*'],
	]); ?>

    <div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
