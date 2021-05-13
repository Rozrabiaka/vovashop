<?php

namespace backend\models;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $product_id
 * @property int $price
 * @property int $status
 * @property int $qty
 * @property string $order_number
 * @property string $phone
 * @property string $delivery_type
 * @property int $payment_type
 * @property string $address
 * @property string|null $date
 *
 * @property Products $product
 */
class Orders extends \yii\db\ActiveRecord
{
    const NEW_POST = 1;
    const DELIVERY = 2;
    const STORE_DELIVERY = 3;

    const PAYMENT_BANK = 1;
    const PAYMENT_CASH = 2;
    const PAYMENT_COD = 3;

    const STATUS_NEW = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_AWAITING_PAYMENT = 3;
    const STATUS_PAID = 4;
    const STATUS_CANCELED = 5;
    const STATUS_ON_THE_AWAY = 6;
    const STATUS_DECLINED = 7;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'delivery_type', 'address', 'first_name', 'last_name'], 'required'],
            [['product_id', 'price', 'status', 'qty', 'payment_type'], 'integer'],
            [['date'], 'safe'],
            [['order_number', 'phone', 'delivery_type'], 'string', 'max' => 20],
            [['address', 'first_name', 'last_name'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'price' => 'Цена',
            'status' => 'Статус',
            'qty' => 'Количество',
            'order_number' => 'Номер заказа',
            'phone' => 'Телефон',
            'delivery_type' => 'Тип доставки',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'payment_type' => 'Тип оплаты',
            'address' => 'Адресс',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    public function getDropDownDelivery()
    {
        return array(
            self::NEW_POST => 'Новая почта',
            self::DELIVERY => 'Деливери',
            self::STORE_DELIVERY => 'Доставка магазина'
        );
    }

    public function generateRandomOrderNumber()
    {
        $today = date("md");
        $rand = strtoupper(substr(uniqid(sha1(time())), 0, 5));
        return $today . $rand;
    }

    public static function getStatusFilerList()
    {
        return array(
            self::STATUS_NEW => 'Новый заказ',
            self::STATUS_PROCESSING => 'В процесе',
            self::STATUS_AWAITING_PAYMENT => 'Ожидает оплату',
            self::STATUS_PAID => 'Оплачено',
            self::STATUS_ON_THE_AWAY => 'В пути',
            self::STATUS_CANCELED => 'Завершено',
            self::STATUS_DECLINED => 'Отклонено',
        );
    }

    public static function getPaymentFilerList()
    {
        return array(
            self::PAYMENT_BANK => 'Карта/Банковский перевод',
            self::PAYMENT_CASH => 'Наличкой',
            self::PAYMENT_COD => 'Наложенный платеж',
        );
    }

    public static function getDeliveryFilerList()
    {
        return array(
            self::NEW_POST => 'Новая почта',
            self::DELIVERY => 'Деливери',
            self::STORE_DELIVERY => 'Доставка магазина'
        );
    }

    public static function getDeliveryTypeView($deliveryType)
    {
        if ($deliveryType == self::NEW_POST) return 'Новая почта';
        if ($deliveryType == self::STORE_DELIVERY) return 'Доставка магазина';
        if ($deliveryType == self::DELIVERY) return 'Деливери';
    }

    public static function getPaymentTypeView($paymentType)
    {
        if ($paymentType == self::PAYMENT_BANK) return 'Карта/Банковский перевод';
        if ($paymentType == self::PAYMENT_CASH) return 'Наличкой';
        if ($paymentType == self::PAYMENT_COD) return 'Наложенный платеж';
    }

    public static function getStatusTypeView($statusType)
    {
        if ($statusType == self::STATUS_NEW) return 'Новый заказ';
        if ($statusType == self::STATUS_PROCESSING) return 'В процесе';
        if ($statusType == self::STATUS_AWAITING_PAYMENT) return 'Ожидает оплату';
        if ($statusType == self::STATUS_PAID) return 'Оплачено';
        if ($statusType == self::STATUS_ON_THE_AWAY) return 'В пути';
        if ($statusType == self::STATUS_CANCELED) return 'Завершено';
        if ($statusType == self::STATUS_DECLINED) return 'Отклонено';
    }
}
