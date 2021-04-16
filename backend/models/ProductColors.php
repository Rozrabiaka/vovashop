<?php

namespace backend\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product_colors".
 *
 * @property int $id
 * @property string $name
 *
 * @property Products[] $products
 */
class ProductColors extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'product_colors';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['name'], 'required'],
			[['name'], 'string', 'max' => 255],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
		];
	}

	/**
	 * Gets query for [[Products]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getProducts()
	{
		return $this->hasMany(Products::className(), ['color' => 'id']);
	}

	public function getAllMarks()
	{
		return self::find()->all();
	}

	public function getArrayDropDownColors()
	{
		$allColors = ArrayHelper::map($this->getAllMarks(), 'id', 'name');
		return $allColors;
	}
}
