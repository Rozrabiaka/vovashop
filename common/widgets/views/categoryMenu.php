<?php
/* @var $model backend\models\Categories */
?>

<div class="categories-menu">
    <div class="header-bottom">
        <div class="header-sticky">
            <div class="container">
                <div class="row col-md-12 col-sm-offset-1 hid monitor-menu">
                    <div class="row">
                        <!-- Header Menu Start -->
                        <div class="col-sm-6 col-sm-offset-2 text-center">
                            <div class="main-menu">
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
</div>

