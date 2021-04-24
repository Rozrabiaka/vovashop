<?php

use yii\db\Migration;

/**
 * Class m210424_074234_products_attributes_multiple
 */
class m210424_074234_products_attributes_multiple extends Migration
{
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%products_attributes_multiple}}', [
			'id' => $this->primaryKey(),
			'product_id' => $this->integer(11)->notNull(),
			'frame_number' => $this->string()->notNull(),
			'engine_number' => $this->string()->notNull(),
		], $tableOptions);

		$this->addForeignKey('fk_products_attributes_multiple', 'products_attributes_multiple', 'product_id', 'products', 'id');
	}
}
