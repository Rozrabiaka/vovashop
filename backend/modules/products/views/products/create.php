<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Products */
/* @var $allCategories backend\modules\marks\controllers\MarksController */
/* @var $allMarks backend\modules\marks\controllers\MarksController */
/* @var $productStatus backend\modules\products\controllers\ProductsController */
/* @var $productsImage backend\modules\products\controllers\ProductsController */
/* @var $productColors backend\modules\products\controllers\ProductsController */

$this->title = 'Создать Продукт';
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'productColors' => $productColors,
		'productsImage' => $productsImage,
		'productStatus' => $productStatus,
		'allMarks' => $allMarks,
		'allCategories' => $allCategories,
		'model' => $model,
	]) ?>
</div>
