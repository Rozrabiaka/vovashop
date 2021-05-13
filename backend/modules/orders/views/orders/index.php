<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \backend\models\Orders;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
                'filter' => Orders::getStatusFilerList()
            ],
            'qty',
            'order_number',
            'phone',
            [
                'attribute' => 'delivery_type',
                'value' => function ($model) {
                    return Orders::getDeliveryTypeView($model->delivery_type);
                },

                'filter' => Orders::getDeliveryFilerList()
            ],
            [
                'attribute' => 'payment_type',
                'value' => function ($model) {
                    if ($model->payment_type == Orders::PAYMENT_BANK) return 'Карта/Банковский перевод';
                    if ($model->payment_type == Orders::PAYMENT_CASH) return 'Наличкой';
                    if ($model->payment_type == Orders::PAYMENT_COD) return 'Наложенный платеж';

                    return 'None';
                },
                'filter' => Orders::getPaymentFilerList()
            ],
            'address',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
