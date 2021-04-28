<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\user */
/* @var $roles backend\modules\user\controllers\UserController */

$this->title = 'Update User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->username]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_formUpdate', [
		'roles' => $roles,
		'model' => $model,
	]) ?>

</div>
