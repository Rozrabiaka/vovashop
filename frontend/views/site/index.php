<?php

/* @var $this yii\web\View */
/* @var $products frontend\controllers\SiteController */

$this->title = 'ZEMISMOTO Главная страница';
?>

<!-- Feature Section Start -->
<div class="section">
    <div class="row">
        <div class="hero-slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!-- Hero Slider Item Start -->
                    <div class="hero-slide-item swiper-slide">
                        <!-- Hero Slider Bg Image Start -->
                        <div class="hero-slide-bg">
                            <img src="images/header-image1.jpg" alt="Slider Image"/>
                        </div>
                        <!-- Hero Slider Bg image End -->

                        <!-- Hero Slider Content Start -->
                        <div class="container">
                            <div class="hero-slide-content">
                                <h2 class="title">
                                    ZEMISMOTO<br/>
                                    Лучшее для вас
                                </h2>
                                <p>Лучший выбор мопедов и мотоциклов</p>
                                <a href="site/products" class="btn btn-lg btn-primary btn-hover-dark">Купить сейчас</a>
                            </div>
                        </div>
                        <!-- Hero Slider Content End -->
                    </div>
                    <!-- Hero Slider Item End -->

                    <!-- Hero Slider Item Start -->
                    <div class="hero-slide-item swiper-slide">

                        <!-- Hero Slider Bg Image Start -->
                        <div class="hero-slide-bg">
                            <img src="images/slide-1-2.jpg" alt="Slider Image"/>
                        </div>
                        <!-- Hero Slider Bg Image End -->

                        <!-- Hero Slider Content Start -->
                        <div class="container">
                            <div class="hero-slide-content">
                                <h2 class="title">
                                    ZEMISMOTO<br/>
                                    Сделай свою покупку
                                </h2>
                                <p>Доставим товар в любую точку Украины.</p>
                                <a href="site/products" class="btn btn-lg btn-primary btn-hover-dark">Купить сейчас</a>
                            </div>
                        </div>
                        <!-- Hero Slider Content End -->

                    </div>
                    <!-- Hero Slider Item End -->

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Section Start -->
    <div class="section about-feature-bg section-padding">
        <div class="container">
            <div class="row mb-n5">
                <!-- Feature Start -->
                <div class="col-sm-4">
                    <div class="feature flex-column text-center">
                        <div class="icon w-100 mb-4">
                            <img src="images/icons/feature-icon-2.png" alt="Feature Icon">
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
                            <img src="images/icons/feature-icon-3.png" alt="Feature Icon">
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
                            <img src="images/icons/feature-icon-4.png" alt="Feature Icon">
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

            <div class="row">
                <div class="shop_wrapper grid_4">
                    <!-- Single Product Start -->
                    <?php
                    $i = 0;
                    foreach ($products as $data):
                        $i++;
                        ?>
                        <?php if ($i == 4): ?>
                        <div class="row">
                    <?php endif; ?>
                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5 product">
                            <div class="product-inner">
                                <div class="thumb">
                                    <a href="/site/product?id=<?php echo $data['id'] ?>" class="image">
                                        <img class="first-image" src="<?php echo $data['image_path'] ?>"
                                             alt="Product"/>
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="title"><a
                                                href="/site/product?id=<?php echo $data['id'] ?>"><?php echo $data['name'] ?></a>
                                    </h5>
                                    <span class="price">
                                            <span class="new"><?php echo $data['price'] ?> грн.</span>
                                    </span>
                                    <div class="shop-list-btn">
                                        <a class="btn btn-sm btn-outline-dark btn-hover-primary show-product"
                                           href="/site/product?id=<?php echo $data['id'] ?>"> Посмотреть продукт</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($i == 4):$i = 0; ?>
                        </div>
                    <? endif; ?>

                    <?php endforeach; ?>
                    <!-- Single Product End -->
                </div>
            </div>
            <!-- Shop Wrapper End -->
        </div>
    </div>
    <!-- Shop Section End -->
</div>