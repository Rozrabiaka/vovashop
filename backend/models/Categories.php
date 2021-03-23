<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 */
class Categories extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'categories';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['name'], 'required'],
			[['name'], 'string', 'max' => 255],
			[['name'], 'unique'],
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

	public function getAllCategories()
	{
		return self::find()->all();
	}

	public function getArrayDropDownCategories()
	{
		return $allCategories = ArrayHelper::map($this->getAllCategories(), 'id', 'name');
	}

	public function issetCategoryByName($name)
	{
		return self::find()->where(['name' => $name])->one();
	}
}
