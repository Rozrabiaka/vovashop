<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RelationsCategory */
/* @var $checkboxArray backend\models\RelationsCategory */

$this->title = 'Связи подкатегорий с категориями';
$this->params['breadcrumbs'][] = ['label' => 'Связи подкатегорий с категориями', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relations-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'checkboxArray' => $checkboxArray,
    ]) ?>

</div>
