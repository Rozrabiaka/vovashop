<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcategories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Create Subcategories', ['create'], ['class' => 'btn btn-success']) ?>
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
