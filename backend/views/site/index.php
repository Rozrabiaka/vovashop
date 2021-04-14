<?php

/* @var $this yii\web\View */
/* @var $courseModel backend\models\CourseDollar */
/* @var $course backend\controllers\SiteController */

$this->title = 'Admin panel home page';

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="row">
    <div class="col-lg-4">
        <h2>Курс выставленный вами: <?php echo $course ?> </h2>

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($courseModel, 'course')->textInput(['maxlength' => true, 'value' => $course]) ?>

        <div class="form-group">
			<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

		<?php ActiveForm::end(); ?>
    </div>
</div>
