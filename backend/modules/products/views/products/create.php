<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Products */
/* @var $allCategories backend\modules\marks\controllers\MarksController */
/* @var $allMarks backend\modules\marks\controllers\MarksController */
/* @var $productStatus backend\modules\marks\controllers\MarksController */
/* @var $productsImage backend\modules\marks\controllers\MarksController */

$this->title = 'Create Products';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'productsImage' => $productsImage,
		'productStatus' => $productStatus,
		'allMarks' => $allMarks,
		'allCategories' => $allCategories,
		'model' => $model,
	]) ?>
</div>
