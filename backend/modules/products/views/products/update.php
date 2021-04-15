<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Products */
/* @var $allCategories backend\modules\marks\controllers\MarksController */
/* @var $allMarks backend\modules\marks\controllers\MarksController */
/* @var $productStatus backend\modules\marks\controllers\MarksController */

$this->title = 'Редактировать Продукт: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
		'allMarks' => $allMarks,
		'allCategories' => $allCategories,
		'productStatus' => $productStatus,
        'model' => $model,
    ]) ?>

</div>
