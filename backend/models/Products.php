<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int $subcategory_id
 * @property int $price
 * @property int $qty
 * @property int|null $model
 * @property string $description
 * @property int $product_status
 * @property string $date
 * @property int $user_added
 *
 * @property Categories $category
 * @property Subcategories $subcategory
 * @property ProductsImage[] $productsImages
 */
class Products extends \yii\db\ActiveRecord
{

	CONST PRODUCT_ACTIVE = 1;
	CONST PRODUCT_INACTIVE = 0;

	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'products';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['name', 'category_id', 'price', 'qty', 'description', 'date', 'user_added'], 'required'],
			[['category_id', 'subcategory_id', 'price', 'qty', 'model', 'product_status', 'user_added'], 'integer'],
			[['description'], 'string'],
			[['date'], 'safe'],
			[['name'], 'string', 'max' => 255],
			[['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
			[['subcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategories::className(), 'targetAttribute' => ['subcategory_id' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Название',
			'category_id' => 'Категория',
			'subcategory_id' => 'Подкатегория',
			'price' => 'Цена',
			'qty' => 'Количество',
			'model' => 'Марка',
			'description' => 'Описание',
			'product_status' => 'Статус',
			'date' => 'Дата',
			'user_added' => 'Пользователь',
		];
	}

	/**
	 * Gets query for [[Category]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(Categories::className(), ['id' => 'category_id']);
	}

	/**
	 * Gets query for [[Subcategory]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getSubcategory()
	{
		return $this->hasOne(Subcategories::className(), ['id' => 'subcategory_id']);
	}

	/**
	 * Gets query for [[ProductsImages]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getProductsImages()
	{
		return $this->hasMany(ProductsImage::className(), ['product_id' => 'id']);
	}

	public function getStatusToDropDownList()
	{
		return array(
			self::PRODUCT_ACTIVE => 'Активне',
			self::PRODUCT_INACTIVE => 'Неактивен'
		);
	}
}
