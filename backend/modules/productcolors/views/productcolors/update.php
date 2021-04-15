<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\productColors */

$this->title = 'Update Product Colors: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Colors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-colors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
