<?php

namespace frontend\controllers;

use backend\models\Orders;
use backend\models\Products;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $products = Products::find()
            ->select(['products.id', 'products.name', 'products.price', 'products.qty', 'products_image.image_path'])
            ->leftJoin('products_image', 'products_image.product_id = products.id')
            ->groupBy(['products.id', 'products.name', 'products.price', 'products.qty', 'products_image.image_path'])
            ->where(['products.product_status' => Products::PRODUCT_ACTIVE])
            ->orderBy('products.id DESC')
            ->limit(12)
            ->asArray()
            ->all();

        $this->getView()->registerCssFile("@web/css/swiper.min.css");
        $this->getView()->registerJsFile("@web/js/swiper.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->getView()->registerJsFile("@web/js/swiper-custom.js", ['depends' => [\yii\web\JqueryAsset::className()]]);

        return $this->render('index', [
            'products' => $products
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionProduct($id)
    {
        if (!empty($id)) {
            $model = Products::findOne($id);
            if (!empty($model)) {
                $this->getView()->registerCssFile("@web/css/swiper.min.css");
                $this->getView()->registerJsFile("@web/js/swiper.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
                $this->getView()->registerJsFile("@web/js/product.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
                $this->getView()->registerJsFile("@web/js/add-to-cart.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
            } else return $this->redirect(['error']);

            return $this->render('product', [
                'model' => $model,
            ]);
        }

        return $this->redirect(['error']);
    }

    public function actionCart()
    {
        $request = Yii::$app->request;

        if (!empty($request->get('remove')) and $request->get('remove') == 'true') {
            $id = $request->get('id');
            if (!empty($id)) {
                $id = abs((int)$id);
                $session = Yii::$app->session;
                $cart = $session->get('cart');
                if (!empty($cart)) {
                    unset($cart['products'][$id]);
                    if (count($cart['products']) == 0) {
                        $session->set('cart', []);
                    }

                    $amount = 0.0;
                    foreach ($cart['products'] as $item) {
                        $amount = $amount + $item['price'] * $item['count'];
                    }
                    $cart['amount'] = $amount;

                    $session->set('cart', $cart);
                }
            }
            //remove from cart
        }

        $session = Yii::$app->session;
        $cart = $session->get('cart');

        return $this->render('cart', [
            'cart' => $cart['products'],
            'amount' => $cart['amount']
        ]);
    }

    public function actionCheckout()
    {
        $session = Yii::$app->session;
        $cart = $session->get('cart');

        if (empty($cart['products']))
            return $this->redirect(['cart']);

        $model = new Orders();
        $orderNumber = $model->generateRandomOrderNumber();

        if (!empty(Yii::$app->request->post())) {
            foreach ($cart['products'] as $key => $order) {
                $insertArray[] = array(
                    'product_id' => (string)$key,
                    'price' => $order['price'],
                    'status' => Orders::STATUS_NEW,
                    'qty' => $order['count'],
                    'order_number' => $orderNumber,
                    'phone' => Yii::$app->request->post('Orders')['phone'],
                    'delivery_type' => Yii::$app->request->post('Orders')['delivery_type'],
                    'payment_type' => Yii::$app->request->post('Orders')['payment_type'],
                    'address' => Yii::$app->request->post('Orders')['address'],
                    'date' => date('Y-m-d H:i:s'),
                    'first_name' => Yii::$app->request->post('Orders')['first_name'],
                    'last_name' => Yii::$app->request->post('Orders')['last_name'],
                    'color' => $order['color'],
                );

                $product = Products::findOne($key);
                $newQty = (int)$product->qty - (int)$order['count'];
                if ($newQty < 0) $newQty = 0;

                if ($newQty > 0) $product->updateAttributes(['qty' => $newQty]);
                else $product->updateAttributes(['qty' => $newQty, 'product_status' => Products::PRODUCT_INACTIVE]);
            }

            Yii::$app->db->createCommand()->batchInsert($model::tableName(),
                ['product_id', 'price', 'status', 'qty', 'order_number', 'phone', 'delivery_type', 'payment_type', 'address', 'date', 'first_name', 'last_name', 'color'],
                $insertArray
            )->execute();

            $session->destroy();

            return $this->redirect(['order', 'ordernumber' => $orderNumber]);
        }

        $this->getView()->registerJsFile("@web/js/checkout.js", ['depends' => [\yii\web\JqueryAsset::className()]]);

        return $this->render('checkout', [
            'model' => $model,
            'amount' => $cart['amount']
        ]);
    }

    public function actionOrder($ordernumber)
    {
        $order = Orders::find()->select(['id'])->where(['order_number' => $ordernumber])->all();
        if (!empty($order)) {
            return $this->render('order', [
                'ordernumber' => $ordernumber,
            ]);
        }

        return $this->render('error');
    }

    public function actionProducts()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Products::find()->select(['products.id', 'products.name', 'products.price', 'products_image.image_path'])->where(['product_status' => Products::PRODUCT_ACTIVE])
                ->leftJoin('products_image', 'products.id = products_image.product_id')
                ->groupBy('products_image.product_id')
                ->asArray(),
            'pagination' => [
                'pageSize' => 2,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
        ]);

        return $this->render('products', [
            'dataProvider' => $dataProvider
        ]);
    }
}
