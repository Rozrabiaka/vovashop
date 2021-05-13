<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\widgets\SearchWidget;
use common\widgets\CategoryHeaderMenuWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="header">
        <?php
        $session = Yii::$app->session;
        NavBar::begin([
            'brandLabel' => 'ZEMISMOTO',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'main-navbar header header-actions',
            ],
        ]);
        $menuItems = [
            ['label' => 'О нас', 'url' => ['/site/contact']],
            ['label' => 'Каталог', 'url' => ['/site/products']],
            ['label' => '0 68 807 1420', 'url' => 'tel:0688071420'],
            ['label' => SearchWidget::widget(),
                'encode' => false,
                'options' => ['class' => 'search-li']],
            ['label' => '<svg width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
  <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
</svg>
                                    <span class="header-action-num">' . ((!empty($session->get('cart')['products'])) ? count($session->get('cart')['products']) : "0") . '</span>',
                'url' => ['/site/cart'],
                'class' => 'header-action-btn header-action-btn-cart',
                'encode' => false],
        ];
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
        <?php echo CategoryHeaderMenuWidget::widget() ?>
    </div>
    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<div id="site-block-message">
    <div class="info-site-block-message text-justify"></div>
    <button class="btn btn-outline-dark btn-hover-primary site-block-close-button">OK</button>
</div>
<div class="footer-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <div class="copyright-content">
                    <p class="mb-0">Copyright © 2021 <a href="<?= \yii\helpers\Url::home('https') ?>"> ZEMISMOTO.</a>
                        Все права защищены.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
