<?php

/* @var $this yii\web\View */
/* @var $cart frontend\controllers\SiteController */
/* @var $amount frontend\controllers\SiteController */

$this->title = 'ZEMISMOTO Корзина';
?>

<!-- Cart Section Start -->
<div class="section section-margin">
    <?php if (!empty($cart)): ?>
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- Cart Table Start -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">

                            <!-- Table Head Start -->
                            <thead>
                            <tr>
                                <th class="pro-thumbnail">Изображение</th>
                                <th class="pro-title">Продукт</th>
                                <th class="pro-price">Цена</th>
                                <th class="pro-quantity">Количесто</th>
                                <th class="pro-subtotal">Цвет</th>
                                <th class="pro-remove">Удалить с корзины</th>
                            </tr>
                            </thead>
                            <!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                            <?php foreach ($cart as $key => $data): ?>
                                <tr>
                                    <td class="pro-thumbnail"><a href="/site/product?id=<?php echo $key ?>"><img
                                                    class="img-fluid"
                                                    src="<?php echo $data['image_path'] ?>"
                                                    alt="Product"/></a></td>
                                    <td class="pro-title"><a
                                                href="/site/product?id=<?php echo $key ?>"><?php echo $data['name'] ?></a>
                                    </td>
                                    <td class="pro-price"><span><?php echo $data['price'] ?></span></td>
                                    <td class="pro-price"><span><?php echo $data['count'] ?></span></td>
                                    <td class="pro-subtotal"><span><?php echo $data['colorName'] ?></span></td>
                                    <td class="pro-remove"><a href="/site/cart?id=<?php echo $key ?>&remove=true">
                                            <svg width="16" height="16" fill="currentColor" class="bi bi-trash"
                                                 viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd"
                                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <!-- Table Body End -->

                        </table>
                    </div>
                    <!-- Cart Table End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 ms-auto col-custom">
                    <!-- Cart Calculation Area Start -->
                    <div class="cart-calculator-wrapper">

                        <!-- Cart Calculate Items Start -->
                        <div class="cart-calculate-items">

                            <!-- Cart Calculate Items Title Start -->
                            <h3 class="title">Цена</h3>
                            <!-- Cart Calculate Items Title End -->

                            <!-- Responsive Table Start -->
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Промежуточный итог</td>
                                        <td><?php echo $amount ?> грн.</td>
                                    </tr>
                                    <tr class="total">
                                        <td>Полная цена</td>
                                        <td class="total-amount"><?php echo $amount ?> грн.</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Responsive Table End -->

                        </div>
                        <!-- Cart Calculate Items End -->

                        <!-- Cart Checktout Button Start -->
                        <a href="checkout" class="btn btn-dark btn-hover-primary rounded-0 w-100">Proceed To
                            Checkout</a>
                        <!-- Cart Checktout Button End -->

                    </div>
                    <!-- Cart Calculation Area End -->
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container">
            <div class="row">
                <div class="cart-none">
                    <div class="col-lg-12">
                        <img src="/images/cart-none.png"/>
                    </div>
                    <div class="col-lg-12 cart-none-text">
                        <p>Корзина пуста</p>
                        Как можно уйти с магазина ничего не купив? Что вы скажете семье по этому поводу?
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<!-- Shopping Cart Section End -->