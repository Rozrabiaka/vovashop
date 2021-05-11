<?php
/* @var $model backend\models\Products */
?>

<div class="product-inner">
    <div class="thumb">
        <a href="/site/product?id=<?php echo $model['id'] ?>" class="image">
            <img class="first-image" src="<?php echo $model['image_path'] ?>"
                 alt="Product"/>
        </a>
    </div>
    <div class="content">
        <h5 class="title"><a
                    href="/site/product?id=<?php echo $model['id'] ?>"><?php echo $model['name'] ?></a>
        </h5>
        <span class="price">
                                            <span class="new"><?php echo $model['price'] ?> грн.</span>
                                    </span>
        <div class="shop-list-btn">
            <a class="btn btn-sm btn-outline-dark btn-hover-primary show-product"
               href="/site/product?id=<?php echo $model['id'] ?>"> Просмотреть продкт</a>
        </div>
    </div>
</div>



