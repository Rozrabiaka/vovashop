<?php
/* @var $dataProvider frontend\controllers\SiteController */

$this->title = 'ZEMISMOTO Список продуктов';
?>

<div class="section">
    <!-- Feature Section Start -->
    <div class="section about-feature-bg section-padding">
        <div class="container">
            <div class="row mb-n5">
                <!-- Feature Start -->
                <div class="col-sm-4">
                    <div class="feature flex-column text-center">
                        <div class="icon w-100 mb-4">
                            <img src="/images/icons/feature-icon-2.png" alt="Feature Icon">
                        </div>
                        <div class="content ps-0 w-100">
                            <h5 class="title mb-2">Доставка</h5>
                            <p>Отправим товар в любую точку Украины. Вам нужно выбрать только способ дотавки.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature End -->

                <!-- Feature Start -->
                <div class="col-sm-4">
                    <div class="feature flex-column text-center">
                        <div class="icon w-100 mb-4">
                            <img src="/images/icons/feature-icon-3.png" alt="Feature Icon">
                        </div>
                        <div class="content ps-0 w-100">
                            <h5 class="title mb-2">Поддержка 24/7</h5>
                            <p>Наша поддержка работает 24/7. Мы всегда будем рады вам помочь!</p>
                        </div>
                    </div>
                </div>
                <!-- Feature End -->
                <!-- Feature Start -->
                <div class="col-sm-4">
                    <div class="feature flex-column text-center">
                        <div class="icon w-100 mb-4">
                            <img src="/images/icons/feature-icon-4.png" alt="Feature Icon">
                        </div>
                        <div class="content ps-0 w-100">
                            <h5 class="title mb-2">Возврат товара.</h5>
                            <p>Вы всегда можете вернуть товар если что то пойдет не так.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature End -->
            </div>
        </div>
    </div>
    <!-- Feature Section End -->

    <!-- Product Section Start -->
    <!-- Shop Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-products"><span class="title-products-span">Продукты</span></div>
                </div>
            </div>
            <!-- Shop Wrapper Start -->
            <?php echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_productsPagination.php',
                'options' => [
                    'tag' => 'div',
                    'class' => 'shop_wrapper grid_4 row',
                ],
                'emptyText' => '<strong>Извините, нам не удалось найти товар(ы) по вашему запросу или его нету в наличии.</strong>',
                'itemOptions' => [
                    'tag' => 'div',
                    'class' => 'col-xl-2 col-lg-3 col-md-3 col-sm-5 product',
                ],
                'summary' => 'Показано {count} из {totalCount}', // шаблон для summary
            ]) ?>
            <!-- Shop Wrapper End -->
        </div>
    </div>
    <!-- Shop Section End -->
</div>
