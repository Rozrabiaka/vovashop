<?php

namespace backend\models;

/**
 * This is the model class for table "products_attributes".
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $engine_volume
 * @property string|null $engine_type
 * @property string|null $cooling
 * @property string|null $max_power
 * @property string|null $max_engine_speed
 * @property string|null $compression_ratio
 * @property string|null $supply_system
 * @property string|null $ignition_system
 * @property string|null $launch system
 * @property string|null $kpp
 * @property string|null $chassis
 * @property string|null $frame
 * @property string|null $front_suspension
 * @property string|null $ear_suspension
 * @property string|null $brakes
 * @property string|null $tires
 * @property string|null $dshv
 * @property string|null $wheelbase
 * @property string|null $seat_height
 * @property string|null $ground_clearance
 * @property string|null $dry_weight
 * @property string|null $fuel_tank_volume
 * @property string|null $maximum_speed
 *
 * @property Products $product
 */
class ProductsAttributes extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'products_attributes';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['product_id'], 'required'],
			[['product_id'], 'integer'],
			[['engine_volume', 'engine_type', 'cooling', 'max_power', 'max_engine_speed', 'supply_system', 'ignition_system', 'launch_system', 'kpp', 'frame', 'front_suspension', 'ear_suspension', 'brakes', 'tires', 'dshv', 'seat_height', 'ground_clearance', 'dry_weight', 'fuel_tank_volume', 'maximum_speed'], 'string', 'max' => 255],
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
			'engine_volume' => 'Объем двигателя',
			'engine_type' => 'Тип двигателя',
			'cooling' => 'Охлождение',
			'max_power' => 'Макс. мощность',
			'max_engine_speed' => 'Макс. крутящий момент',
			'supply_system' => 'Сиcтема питания',
			'ignition_system' => 'Система зажигания',
			'launch_system' => 'Система пуска',
			'kpp' => 'КПП / Главная передача',
			'frame' => 'Рама',
			'front_suspension' => 'Передняя подвеска',
			'ear_suspension' => 'Задняя подвеска',
			'brakes' => 'Тормоза, передний / задний',
			'tires' => 'Шины, передняя / задняя',
			'dshv' => 'ДхШхВ',
			'wheelbase' => 'Колесная база',
			'seat_height' => 'Высота по сидению',
			'ground_clearance' => 'Клиренс',
			'dry_weight' => 'Сухой вес',
			'fuel_tank_volume' => 'Обьем топливново бака',
			'maximum_speed' => 'Максимальная скорость',
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
