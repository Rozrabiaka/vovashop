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
/* @var $productStatus backend\modules\marks\controllers\MarksController */
?>

<div class="products-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'category_id')->dropDownList($allCategories, ['prompt' => 'Please, select value']) ?>

	<?= $form->field($model, 'subcategory_id')->dropDownList(['prompt' => 'Please, choose category']) ?>

	<?= $form->field($model, 'price')->textInput() ?>

	<?= $form->field($model, 'qty')->textInput() ?>

	<?= $form->field($model, 'model')->dropDownList($allMarks, ['prompt' => 'Please, select value']) ?>

    <span style="color:red;">ВАЖНО!</span> Если Вы выбрали статус как "неактивен", то продукт не будет отбражаться на
    сайте в продаже
	<?= $form->field($model, 'product_status')->dropDownList($productStatus) ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?= $form->field($productsImage, 'image_path')->widget(FileInput::classname(), [
		'attribute' => 'attachment_48[]',
		'pluginOptions' => [
			'showUpload' => false,
			'overwriteInitial' => true,
			'allowedFileExtensions' => ['jpg', 'png', 'jpeg'],
			'maxFileSize' => 2800
		],
		'options' => ['multiple' => true],
	]); ?>

    <div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
