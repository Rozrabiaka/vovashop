<?php

namespace backend\models;

/**
 * This is the model class for table "relations_category".
 *
 * @property int $id
 * @property int $subcategory
 * @property int $category
 *
 * @property Categories $category0
 * @property Subcategories $subcategory0
 */
class RelationsCategory extends \yii\db\ActiveRecord
{
	public $checkbox;

	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'relations_category';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['subcategory', 'category'], 'required'],
			[['subcategory', 'category'], 'integer'],
			[['checkbox'], 'each', 'rule' => ['integer']],
			[['category'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category' => 'id']],
			[['subcategory'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategories::className(), 'targetAttribute' => ['subcategory' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'subcategory' => 'Подкатегория',
			'category' => 'Категория',
		];
	}

	/**
	 * Gets query for [[Category0]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory0()
	{
		return $this->hasOne(Categories::className(), ['id' => 'category']);
	}

	/**
	 * Gets query for [[Subcategory0]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getSubcategory0()
	{
		return $this->hasOne(Subcategories::className(), ['id' => 'subcategory']);
	}

	public function issetRelation($subId)
	{
		return self::find()->andWhere(['and',
			['subcategory' => $subId],
		])->all();
	}
}
