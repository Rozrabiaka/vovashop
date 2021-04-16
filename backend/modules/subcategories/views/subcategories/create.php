<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Subcategories */
/* @var $dropDownCategories backend\modules\subcategories\controllers\SubcategoriesController */
/* @var $dropDownSubCategories backend\modules\subcategories\controllers\SubcategoriesController */

$this->title = 'Create Subcategories';
$this->params['breadcrumbs'][] = ['label' => 'Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dropDownCategories' => $dropDownCategories,
        'dropDownSubCategories' => $dropDownSubCategories,
    ]) ?>

</div>
