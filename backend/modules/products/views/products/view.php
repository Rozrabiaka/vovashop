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
				'label' => 'Номер рамы',
				'value' => function ($model) {
					return $model->productsAttributes[0]->frame_number;
				},
			],
			[
				'attribute' => 'engine_volume',
				'label' => 'Объем двигателя',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'engine_number',
				'label' => 'Номер двигателя',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'engine_type',
				'label' => 'Тип двигателя',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'cooling',
				'label' => 'Охлождение',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'max_power',
				'label' => 'Макс. мощность',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'max_engine_speed',
				'label' => 'Макс. крутящий момент',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'compression_ratio',
				'label' => 'Степень сжатия',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'supply_system',
				'label' => 'Сиcтема питания',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'ignition_system',
				'label' => 'Система зажигания',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'launch_system',
				'label' => 'Система пуска',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'kpp',
				'label' => 'КПП / Главная передача',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'chassis',
				'label' => 'Шасси',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'frame',
				'label' => 'Рама',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'front_suspension',
				'label' => 'Передняя подвеска',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'ear_suspension',
				'label' => 'Задняя подвеска',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'brakes',
				'label' => 'Тормоза, передний / задний',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'tires',
				'label' => 'Шины, передняя / задняя',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'dshv',
				'label' => 'ДхШхВ',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'wheelbase',
				'label' => 'Колесная база',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'seat_height',
				'label' => 'Высота по сидению',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'ground_clearance',
				'label' => 'Дорожный просвет',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'dry_weight',
				'label' => 'Сухой вес',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'fuel_tank_volume',
				'label' => 'Обьем топливново бака',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
			[
				'attribute' => 'maximum_speed',
				'label' => 'Максимальная скорость',
				'value' => function ($model) {
					return $model->productsAttributes[0]->engine_volume;
				},
			],
		],
	]) ?>

	<?php if (!empty($model->productsImages)): ?>
        <div class="row">
            <div class="admin-view-product-image">
				<?php foreach ($model->productsImages as $images): ?>
                    <div class="col-md-4 block-image-product-view">
						<?= Html::img(Url::to($images->image_path), ['alt' => 'My logo']) ?>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
	<?php else: ?>
        <h4>Картинок для данного продукта не найдено. Чтобы добавить картинки перейдите в раздел редактирования данного
            продукта.</h4>
	<?php endif; ?>
</div>
