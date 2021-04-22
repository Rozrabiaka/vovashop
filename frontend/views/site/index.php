<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $products frontend\controllers\SiteController */

$this->title = 'ZEMISMOTO Главная страница';
?>
<div class="site-index">
    <div class="row">
		<?php foreach ($products as $data): ?>
            <div class="col-md-3 products-main">
                <a href="">
                    <div class="product-image-main">
						<?php echo Html::img(Url::to($data['image_path']), ['alt' => $data['name']]) ?>
                    </div>
                </a>
                <div class="product-info-main">
                    <p><?php echo $data['name'] ?></p>
                    <p><?php echo $data['price'] ?></p>
                    <p><?php echo $data['qty'] ?></p>
                </div>
            </div>
		<?php endforeach; ?>
    </div>
</div>
