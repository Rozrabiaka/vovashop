<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CreateUser */
/* @var $form yii\widgets\ActiveForm */
/* @var $roles backend\modules\user\controllers\UserController */
?>

<div class="user-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'username')->textInput() ?>
	<?= $form->field($model, 'email')->textInput() ?>
	<?= $form->field($model, 'password')->textInput() ?>
	<?= $form->field($model, 'role')->dropDownList($roles, ['prompt' => 'Пожалуйста, выберите роль']) ?>

    <div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
