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
}
