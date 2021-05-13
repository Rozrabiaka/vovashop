<?php
/* @var $model backend\models\Categories */
?>

<div class="categories-menu">
    <div class="header-bottom">
        <div class="header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Header Menu Start -->
                    <div class="col-xl-8 d-none d-xl-block">
                        <div class="main-menu position-relative">
                            <ul>
                                <?php foreach ($model as $data): ?>
                                    <li><a href="/site/products?category=<?php echo $data['id'] ?>">
                                            <span><?php echo $data['name'] ?></span></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Menu End -->
                </div>
            </div>
        </div>
    </div>
</div>

