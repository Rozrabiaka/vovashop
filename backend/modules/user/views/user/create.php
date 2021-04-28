<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\user */
/* @var $roles backend\modules\user\controllers\UserController */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_formCreate', [
		'roles' => $roles,
		'model' => $model,
	]) ?>

</div>
