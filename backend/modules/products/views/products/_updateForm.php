<?php

use yii\helpers\Html;
use yii\helpers\Url;
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
/* @var $imageArray backend\modules\products\controllers\ProductsController */
/* @var $productAttributes backend\models\ProductsAttributes */
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

    <h4 class="product-attributes-show">Характеристики
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
             class="bi bi-arrow-down-circle" viewBox="0 0 16 16">Характеристики
            <path fill-rule="evenodd"
                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
        </svg>
    </h4>
    <div class="product-attributes row">
        <div class="col-md-6"><?= $form->field($productAttributes, 'frame_number')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'engine_volume')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'engine_number')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'engine_type')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'cooling')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'max_power')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'max_engine_speed')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'compression_ratio')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'supply_system')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'ignition_system')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'launch_system')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'kpp')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'chassis')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'frame')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'front_suspension')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'ear_suspension')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'brakes')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'tires')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'dshv')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'wheelbase')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'seat_height')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'ground_clearance')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'dry_weight')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'fuel_tank_volume')->textInput() ?></div>
        <div class="col-md-6"><?= $form->field($productAttributes, 'maximum_speed')->textInput() ?></div>
    </div>

	<?= $form->field($model, 'image[]')->widget(FileInput::classname(), [
		'pluginOptions' => [
			'initialPreview' => $model->imagesLinks,
			'initialPreviewConfig' => $model->imagesLinksData,
			'deleteUrl' => Url::toRoute(['/ajax/delete-product-image']),
			'showRemove' => false,
			'initialPreviewAsData' => true,
			'showUpload' => false,
			'overwriteInitial' => false,
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
