<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $amount frontend\controllers\SiteController */
/* @var $model backend\models\Orders */

$this->title = 'ZEMISMOTO Страница заказа';
?>

<div class="section section-margin">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12 mb-4">
                <?php $form = ActiveForm::begin(['options' => [
                    'class' => 'checkout'
                ]]); ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'first_name')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'last_name')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'address')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'phone')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'delivery_type')->widget(\kartik\select2\Select2::classname(), [
                            'name' => 'delivery_type',
                            'data' => $model->getDropDownDelivery(),
                            'options' => [
                                'placeholder' => 'Пожалуйста, выберите способ оплаты...',
                            ]
                        ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'payment_type')->widget(\kartik\select2\Select2::classname(), [
                            'name' => 'payment_type',
                            'pluginOptions' => [
                                'initialize' => false,
                                'placeholder' => 'Пожалуйста, выберите способ оплаты...',
                            ],
                        ]); ?>
                    </div>
                    <div class="checkout-button">
                        <?= Html::submitButton('Сделать заказ', ['class' => 'btn btn-dark btn-hover-primary rounded-0 w-100']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

            <div class="col-md-6 col-12 mb-4">

                <!-- Your Order Area Start -->
                <div class="your-order-area border">

                    <!-- Title Start -->
                    <h3 class="title">Сума к оплате</h3>
                    <!-- Title End -->

                    <!-- Your Order Table Start -->
                    <div class="your-order-table table-responsive">
                        <table class="table">
                            <!-- Table Footer Start -->
                            <tr class="order-total">
                                <th class="text-start ps-0">Цена к оплате</th>
                                <td class="text-end pe-0"><strong><span class="amount"><?php echo $amount ?> грн.</span></strong>
                                </td>
                            </tr>
                            <!-- Table Footer End -->
                        </table>
                    </div>
                    <!-- Your Order Table End -->
                </div>
                <!-- Your Order Area End -->
            </div>
        </div>
    </div>
</div>
<!-- Checkout Section End -->
