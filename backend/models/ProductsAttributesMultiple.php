<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "products_attributes_multiple".
 *
 * @property int $id
 * @property int $product_id
 * @property string $frame_number
 * @property string $engine_number
 * @property int $relation_number
 *
 * @property Products $product
 */
class ProductsAttributesMultiple extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_attributes_multiple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['frame_number', 'engine_number'], 'string', 'max' => 255],
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
            'frame_number' => 'Номер рамы',
            'engine_number' => 'Номер двигателя',
            'relation_number' => 'Relation Number',
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
}
