<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			[
				'attribute' => 'category_id',
				'value' => function ($model) {
					return $model->category->name;
				},
			],
			[
				'attribute' => 'subcategory_id',
				'value' => function ($model) {
	                if(!empty($model->subcategory->name)) return $model->subcategory->name;
					return '';
				},
			],
			'price',
			'qty',
			[
				'attribute' => 'model',
				'value' => function ($model) {
					if (!empty($model->marks[0]->name)) return $model->marks[0]->name;
					return '';
				},
			],
			[
				'attribute' => 'product_status',
				'value' => function ($model) {
					if ($model->product_status == 1) return 'Активен';
					return 'Неактивен';
				},
			],
			[
				'attribute' => 'user_added',
				'value' => function ($model) {
					return $model->user[0]->username;
				},
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>


</div>
