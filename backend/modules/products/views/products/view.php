<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
			'dollar_price',
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
			[
				'attribute' => 'frame_number',
				'value' => function ($model) {
					return $model->productsAttributes[0]->frame_number;
				},
			],
			[
				'attribute' => 'engine_volume',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'engine_number',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'engine_type',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'cooling',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'max_power',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'max_engine_speed',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'compression_ratio',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'supply_system',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'ignition_system',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'launch_system',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'kpp',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'chassis',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'frame',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'front_suspension',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'ear_suspension',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'brakes',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'tires',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'dshv',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'wheelbase',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'seat_height',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'ground_clearance',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'dry_weight',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'fuel_tank_volume',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'maximum_speed',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
		],
	]) ?>

    <div class="row">
        <div class="admin-view-product-image">
			<?php foreach ($model->productsImages as $images): ?>
                <div class="col-md-4 block-image-product-view">
					<?= Html::img(Url::to($images->image_path), ['alt' => 'My logo']) ?>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</div>
