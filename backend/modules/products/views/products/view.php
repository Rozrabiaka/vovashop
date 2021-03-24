<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Вы уверены что хотите удалить продукт?',
				'method' => 'post',
			],
		]) ?>
    </p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
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
					if (!empty($model->subcategory->name)) return $model->subcategory->name;
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
			'description:ntext',
			[
				'attribute' => 'product_status',
				'value' => function ($model) {
					if ($model->product_status == 1) return 'Активен';
					return 'Неактивен';
				},
			],
			'date',
			[
				'attribute' => 'user_added',
				'value' => function ($model) {
					return $model->user[0]->username;
				},
			],
		],
	]) ?>

</div>
