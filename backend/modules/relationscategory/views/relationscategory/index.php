<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Relations Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relations-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}',
			],
		],
	]); ?>


</div>
