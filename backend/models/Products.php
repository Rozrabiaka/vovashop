<?php

namespace backend\models;

use common\models\User;
use yii\helpers\ArrayHelper;
use Yii;

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

    const PRODUCT_ACTIVE = 1;
    const PRODUCT_INACTIVE = 0;

    public $image;

    public $colors;

    public $color_id;

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
            [['image'], 'file', 'maxFiles' => 16],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['subcategory_id'], 'exist', 'targetClass' => Subcategories::className(), 'targetAttribute' => ['subcategory_id' => 'id']],
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

    public function getProductImage()
    {
        return $this->hasOne(ProductsImage::className(), ['product_id' => 'id']);
    }


    public function getUser()
    {
        return $this->hasMany(User::className(), ['id' => 'user_added']);
    }

    public function getMarks()
    {
        return $this->hasMany(Marks::className(), ['id' => 'model']);
    }

    public function getProductColors()
    {
        return $this->hasMany(ProductColorsRelations::className(), ['product_id' => 'id']);
    }

    public function getColorName()
    {
        return $this->hasMany(ProductColors::className(), ['id' => 'color_id'])->via('productColors');
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

    public function uploadImages()
    {
        $uploadPath = Yii::getAlias('@uploads') . '/products/' . date('Y') . '/' . date('m');
        $path = Yii::getAlias('@frontend') . '/web' . $uploadPath;
        if (!is_dir($path))
            mkdir($path, 0777, true);

        $productId = $this->getPrimaryKey();
        $productImageArray = array();
        foreach ($this->image as $file) {
            $fileName = md5(microtime() . rand(0, 9999)) . '_' . $file->name;
            $imagePath = $path . '/' . $fileName;
            if ($file->saveAs($imagePath)) {
                $productImageArray[] = array(
                    'product_id' => (int)$productId,
                    'image_path' => $uploadPath . '/' . $fileName
                );
            }
        }

        //save to product image table path
        Yii::$app->db->createCommand()->batchInsert(
            ProductsImage::tableName(),
            ['product_id', 'image_path'],
            $productImageArray
        )->execute();

        return true;
    }
}
