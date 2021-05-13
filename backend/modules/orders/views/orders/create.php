<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */
/* @var $statusDropDown backend\models\Orders */
/* @var $deliveryDropDown backend\models\Orders */
/* @var $paymentDropDown backend\models\Orders */

$this->title = 'Create Orders';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'statusDropDown' => $statusDropDown,
        'deliveryDropDown' => $deliveryDropDown,
        'paymentDropDown' => $paymentDropDown,
    ]) ?>

</div>
