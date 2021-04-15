<?php

use yii\db\Migration;

/**
 * Class m210415_131713_product_attributes
 */
class m210415_131713_product_attributes extends Migration
{
    public function safeUp()
    {
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%products_attributes}}', [
			'id' => $this->primaryKey(),
			'product_id' => $this->integer(11)->notNull(),
			'frame_number' => $this->string()->null(),//номер рамы for example LTF12354896245RHDK
			'engine_volume' => $this->integer()->null(), //обьем двигателя
			'engine_number' => $this->integer()->null(), // номер двигателя
			'engine_type' => $this->string()->null(), // тип двигателя
			'cooling' => $this->string()->null(), // охлождение
			'max_power' => $this->string()->null(), // макс мощность
			'max_engine_speed' => $this->string()->null(), // макс крутящий момент
			'compression_ratio' => $this->string()->null(), // степень сжатия
			'supply_system' => $this->string()->null(), // cиcтема питания
			'ignition_system' => $this->string()->null(), // система зажигания
			'launch system' => $this->string()->null(), // система пуска
			'kpp' => $this->string()->null(), // КПП / Главная передача
			'chassis' => $this->string()->null(), // Шасси
			'frame' => $this->string()->null(), // Рама
			'front_suspension' => $this->string()->null(), // Передняя подвеска
			'ear_suspension' => $this->string()->null(), // Задняя подвеска
			'brakes' => $this->string()->null(), // Тормоза, передний / задний
			'tires' => $this->string()->null(), // Шины, передняя / задняя
			'dshv' => $this->string()->null(), // ДхШхВ
			'wheelbase' => $this->string()->null(), // колесная база
			'seat_height' => $this->string()->null(), // высота по сидению
			'ground_clearance' => $this->string()->null(), // дорожный просвет
			'dry_weight' => $this->string()->null(), // сухой вес
			'fuel_tank_volume' => $this->string()->null(), // обьем топливново бака
			'maximum_speed' => $this->string()->null(), // максимальная скорость

		], $tableOptions);

		$this->addForeignKey('fk_products_attribute', 'products_attributes', 'product_id', 'products', 'id');
    }
}
