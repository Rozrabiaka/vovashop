<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \backend\models\Orders;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'product_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->product_id, ['/products/products/view?id=' . $model->product_id]);
                },
            ],
            'price',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Orders::getStatusTypeView($model->status);
                },
            ],
            'qty',
            'order_number',
            'phone',
            [
                'attribute' => 'delivery_type',
                'value' => function ($model) {
                    return Orders::getDeliveryTypeView($model->delivery_type);
                },
            ],
            [
                'attribute' => 'payment_type',
                'value' => function ($model) {
                    return Orders::getPaymentTypeView($model->payment_type);
                },
                'filter' => Orders::getPaymentFilerList()
            ],
            'address',
            'date',
        ],
    ]) ?>

</div>
