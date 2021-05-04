<?php
/* @var $model backend\models\Products */

?>

<!-- Single Product Section Start -->
<div class="section section-margin">
    <div class="container">

        <div class="row">
            <div class="col-lg-5 offset-lg-0 col-md-8 offset-md-2 col-custom">

                <!-- Product Details Image Start -->
                <div class="product-details-img">

                    <!-- Single Product Image Start -->
                    <div class="single-product-img swiper-container gallery-top">
                        <div class="swiper-wrapper popup-gallery">
                            <?php foreach ($model->productsImages as $images): ?>
                                <a class="swiper-slide w-100" href="<?php echo $images->image_path ?>">
                                    <img class="w-100" src="<?php echo $images->image_path ?>" alt="Product">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Single Product Image End -->

                    <!-- Single Product Thumb Start -->
                    <div class="single-product-thumb swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            <?php foreach ($model->productsImages as $images): ?>
                                <a class="swiper-slide" href="<?php echo $images->image_path ?>">
                                    <img src="<?php echo $images->image_path ?>" alt="Product">
                                </a>
                            <?php endforeach; ?>
                        </div>

                        <!-- Next Previous Button Start -->
                        <div class="swiper-button-horizental-next  swiper-button-next"><i class="pe-7s-angle-right"></i>
                        </div>
                        <div class="swiper-button-horizental-prev swiper-button-prev"><i class="pe-7s-angle-left"></i>
                        </div>
                        <!-- Next Previous Button End -->

                    </div>
                    <!-- Single Product Thumb End -->

                </div>
                <!-- Product Details Image End -->

            </div>
            <div class="col-lg-7 col-custom">

                <!-- Product Summery Start -->
                <div class="product-summery position-relative">

                    <!-- Product Head Start -->
                    <div class="product-head mb-3">
                        <h2 class="product-title"><?php echo $model->name ?></h2>
                    </div>
                    <!-- Product Head End -->

                    <!-- Price Box Start -->
                    <div class="price-box mb-2">
                        <span class="regular-price"><?php echo $model->price ?></span>
                    </div>
                    <!-- Price Box End -->

                    <!-- SKU Start -->
                    <div class="sku mb-3">
                        <span>Индификатор продукта: <?php echo $model->id ?></span>
                    </div>
                    <!-- SKU End -->

                    <!-- Description Start -->
                    <p class="desc-content mb-5"><?php echo $model->description ?></p>
                    <!-- Description End -->

                    <!-- Colors -->
                    <div class="shop-short-by mr-4">
                        <select class="nice-select" aria-label=".form-select-sm example">
                            <option value="selected" disabled selected>Пожалуйста, выберите цвет.</option>
                            <?php foreach ($model->colorName as $colors): ?>
                                <option value=<?php echo $colors->name ?>><?php echo $colors->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- end colors -->

                    <!-- Quantity Start -->
                    <div class="quantity mb-5">
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" value="1" type="text">
                        </div>
                    </div>
                    <!-- Quantity End -->

                    <!-- Cart & Wishlist Button Start -->
                    <div class="cart-wishlist-btn mb-4">
                        <div class="add-to_cart">
                            <a class="btn btn-outline-dark btn-hover-primary" href="cart.html">Add to cart</a>
                        </div>
                    </div>
                    <!-- Cart & Wishlist Button End -->

                    <!-- Product Delivery Policy Start -->
                    <ul class="product-delivery-policy border-top pt-4 mt-4 border-bottom pb-4">
                        <li>
                            <svg width="20" height="20" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg>
                            <span>Доставка в любую точку Украины удобным Вам способом.</span>
                        </li>
                        <li>
                            <svg width="20" height="20" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                            </svg>
                            <span>Тех.поддержка всегда готова помочь Вам.</span></li>
                        <li>
                            <svg width="20" height="20" fill="currentColor" class="bi bi-arrow-down-up"
                                 viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                            <span>Возврат товара. </span></li>
                    </ul>
                    <!-- Product Delivery Policy End -->
                </div>
                <!-- Product Summery End -->
            </div>
        </div>

        <div class="row section-margin">
            <!-- Single Product Tab Start -->
            <div class="col-lg-12 col-custom single-product-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="contact-tab" data-bs-toggle="tab" href="#connect-3"
                           role="tab" aria-selected="false">Характеристики</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="contact-tab" data-bs-toggle="tab" href="#connect-3"
                           role="tab" aria-selected="false">Политика доставки</a>
                    </li>
                </ul>

                <div class="product-block-information">
                    <div>
                        //harakteristiki here
                    </div>
                    <div>
                        // politica dostawki
                    </div>
                </div>
                <!-- Single Product Tab End -->
            </div>
        </div>
    </div>
    <!-- Single Product Section End -->
