<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */
/* @var $statusDropDown backend\models\Orders */
/* @var $deliveryDropDown backend\models\Orders */
/* @var $paymentDropDown backend\models\Orders */

$this->title = 'Update Orders: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'statusDropDown' => $statusDropDown,
        'deliveryDropDown' => $deliveryDropDown,
        'paymentDropDown' => $paymentDropDown,
    ]) ?>

</div>
