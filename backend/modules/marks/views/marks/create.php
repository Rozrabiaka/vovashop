<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Marks */

$this->title = 'Создать Марку';
$this->params['breadcrumbs'][] = ['label' => 'Марки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
