<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Subcategories */
/* @var $dropDownCategories backend\modules\subcategories\controllers\SubcategoriesController */
/* @var $dropDownSubCategories backend\modules\subcategories\controllers\SubcategoriesController */

$this->title = 'Update Subcategories: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subcategories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'dropDownCategories' => $dropDownCategories,
		'dropDownSubCategories' => $dropDownSubCategories,
    ]) ?>

</div>
