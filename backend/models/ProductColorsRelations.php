<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_colors_relations".
 *
 * @property int $id
 * @property int $color_id
 * @property int $product_id
 *
 * @property ProductColors $color
 * @property Products $product
 */
class ProductColorsRelations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_colors_relations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color_id', 'product_id'], 'required'],
            [['color_id', 'product_id'], 'integer'],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductColors::className(), 'targetAttribute' => ['color_id' => 'id']],
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
            'color_id' => 'Color ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(ProductColors::className(), ['id' => 'color_id']);
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
