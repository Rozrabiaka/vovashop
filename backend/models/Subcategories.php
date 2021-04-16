<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "subcategories".
 *
 * @property int $id
 * @property float $name
 */
class Subcategories extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */

	public $category;

	public $issetSubCategory;

	public static function tableName()
	{
		return 'subcategories';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['name'], 'required'],
			[['name'], 'string'],
			[['category'], 'integer'],
			[['issetSubCategory'], 'integer'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Подкатегория',
			'category' => 'Категория',
			'issetSubCategory' => 'Существующие подкатегории',
		];
	}

	public function getArrayDropDownSubCategories()
	{
		return ArrayHelper::map($this->getAllSubCategories(), 'id', 'name');
	}

	public function getAllSubCategories()
	{
		return self::find()->all();
	}

	public function getSubCategoryByName($name)
	{
		return self::find()->where(['name' => $name])->one();
	}
}
