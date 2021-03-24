<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "products_image".
 *
 * @property int $id
 * @property int $product_id
 * @property int $image_path
 *
 * @property Products $product
 */
class ProductsImage extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'products_image';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['product_id', 'image_path'], 'required'],
			[['product_id'], 'integer'],
			[['image_path'], 'file', 'extensions' => 'png, jpg, jpeg'],
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
			'image_path' => 'Image Path',
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
