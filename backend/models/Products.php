<?php

namespace backend\models;

use common\models\User;
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

	public $image;

	public $colors;

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
			[['name', 'category_id', 'qty', 'description', 'date', 'user_added'], 'required'],
			[['category_id', 'qty', 'model', 'product_status', 'user_added', 'dollar_price'], 'integer'],
			[['description'], 'string'],
			[['date'], 'safe'],
			[['price'], 'number'],
			[['colors'], 'each', 'rule' => ['integer']],
			[['name'], 'string', 'max' => 255],
			[['image'], 'file', 'maxFiles' => 16, 'skipOnEmpty' => false],
			[['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
			[['subcategory_id'], 'exist', 'skipOnEmpty' => true, 'skipOnError' => true, 'targetClass' => Subcategories::className(), 'targetAttribute' => ['subcategory_id' => 'id']],
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
			'price' => 'Цена в гривнах',
			'dollar_price' => 'Цена в долларах',
			'qty' => 'Количество',
			'model' => 'Марка',
			'description' => 'Описание',
			'product_status' => 'Статус',
			'date' => 'Дата',
			'colors' => 'Цвета',
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

	public function getUser()
	{
		return $this->hasMany(User::className(), ['id' => 'user_added']);
	}

	public function getMarks()
	{
		return $this->hasMany(Marks::className(), ['id' => 'model']);
	}

	public function getProductsAttributes()
	{
		return $this->hasMany(ProductsAttributes::className(), ['product_id' => 'id']);
	}

	public function getImagesLinks()
	{
		return ArrayHelper::getColumn($this->productsImages, 'image_path');
	}

	public function getProductsAttributesMultiple()
	{
		return $this->hasMany(ProductsAttributesMultiple::className(), ['product_id' => 'id']);
	}

	public function getImagesLinksData()
	{
		return ArrayHelper::toArray($this->productsImages, [
			ProductsImage::className() => [
				'key' => 'id'
			]
		]);
	}

	public function getStatusToDropDownList()
	{
		return array(
			self::PRODUCT_ACTIVE => 'Активне',
			self::PRODUCT_INACTIVE => 'Неактивен'
		);
	}
}
