<?php

namespace frontend\controllers;

use backend\models\Orders;
use backend\models\ProductColors;
use backend\models\Products;
use yii\web\Controller;
use Yii;
use yii\helpers\Json;

class AjaxController extends Controller
{
    public function actionCart()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->get('id');
            $count = Yii::$app->request->get('count');
            $color = Yii::$app->request->get('color');

            $id = abs((int)$id);

            $product = Products::find()
                ->select(['products.id', 'products.name', 'products.price', 'products.qty', 'products_image.image_path'])
                ->leftJoin('products_image', 'products_image.product_id = products.id')
                ->groupBy(['products.id', 'products.name', 'products.price', 'products.qty', 'products_image.image_path'])
                ->where(['products.id' => $id])
                ->orderBy('products.id DESC')
                ->asArray()
                ->all();

            $color = ProductColors::find()->select(['id', 'name'])->where(['id' => $color])->one();

            if (!empty($color)) {
                $colorName = $color->name;
                $colorId = $color->id;
            } else {
                return JSON::encode([
                    'success' => false,
                    'message' => 'Не удалось найти выбранный вами цвет.',
                ]);
            }

            if (empty($product)) {
                return JSON::encode([
                    'success' => false,
                    'message' => 'Не удалось найти данный продукт.',
                ]);
            }
            $product = $product[0];

            $session = Yii::$app->session;
            $session->open();

            if (!$session->has('cart')) {
                $session->set('cart', []);
                $cart = [];
            } else {
                $cart = $session->get('cart');
            }
            if (isset($cart['products'][$product['id']])) { // такой товар уже есть?
                $count = $cart['products'][$product['id']]['count'] + $count;
                $cart['products'][$product['id']]['count'] = $count;

                if ($count > $product['qty']) {
                    return JSON::encode([
                        'success' => false,
                        'message' => 'Вы не можете купить больше. Максимальное количество для покупки ' . $product['qty'] . ' .Вы пытаетесь купить ' . $count,
                    ]);
                }
            } else { // такого товара еще нет
                $cart['products'][$product['id']]['price'] = $product['price'];
                $cart['products'][$product['id']]['count'] = $count;
                $cart['products'][$product['id']]['image_path'] = $product['image_path'];
                $cart['products'][$product['id']]['color'] = $colorId;
                $cart['products'][$product['id']]['colorName'] = $colorName;
                $cart['products'][$product['id']]['name'] = $product['name'];

                if ($count > $product['qty']) {
                    return JSON::encode([
                        'success' => false,
                        'message' => 'Вы не можете купить больше. Максимальное количество для покупки ' . $product['qty'] . ' .Вы пытаетесь купить ' . $count,
                    ]);
                }
            }
            $amount = 0.0;
            foreach ($cart['products'] as $item) {
                $amount = $amount + $item['price'] * $item['count'];
            }
            $cart['amount'] = $amount;
            $session->set('cart', $cart);

            $cartCount = count($session->get('cart')['products']);
            return JSON::encode([
                'success' => true,
                'message' => 'Продукт был успешно добавлен в корзину. Количество товара которое вы хотите купить = ' . $count . ' .Вы будете перенаправлены в корзину через 4 секунды.',
                'cartCount' => $cartCount,
            ]);
        }

        return JSON::encode([
            'success' => false,
            'message' => 'Возникла проблема с добавлением товара в корзину.',
        ]);
    }

    public function actionPayment()
    {
        if (Yii::$app->request->isAjax) {
            $delivery = Yii::$app->request->get('delivery');

            if ($delivery == Orders::DELIVERY or $delivery == Orders::NEW_POST) {
                return JSON::encode([
                    'success' => true,
                    'message' => array(
                        'Оплата на карту / Банковский перевод' => Orders::PAYMENT_BANK,
                        'Оплата наличкой' => Orders::PAYMENT_CASH,
                        'Наложенный платеж' => Orders::PAYMENT_COD,
                    )
                ]);
            }

            if ($delivery == Orders::STORE_DELIVERY) {
                return JSON::encode([
                    'success' => true,
                    'message' => array(
                        'Оплата на карту / Банковский перевод' => Orders::PAYMENT_BANK,
                        'Оплата наличкой' => Orders::PAYMENT_CASH
                    )
                ]);
            }
        }

        return JSON::encode([
            'success' => false,
            'message' => 'Ошибка при выборе оплаты.',
        ]);
    }
}