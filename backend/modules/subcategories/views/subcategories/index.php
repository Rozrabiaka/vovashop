<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Подкатегории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Создать Подкатегорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			[
				'attribute' => 'category_id',
				'value' => function ($model) {
					return $model->categories->name;
				},
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
