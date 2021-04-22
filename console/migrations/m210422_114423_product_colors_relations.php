<?php

use yii\db\Migration;

/**
 * Class m210422_114423_product_colors_relations
 */
class m210422_114423_product_colors_relations extends Migration
{
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%product_colors_relations}}', [
			'id' => $this->primaryKey(),
			'color_id' => $this->integer(11)->notNull(),
			'product_id' => $this->integer(11)->notNull()
		], $tableOptions);

		$this->addForeignKey('fk_products_colors_color_id', 'product_colors_relations', 'color_id', 'product_colors', 'id');
		$this->addForeignKey('fk_products_colors_product_id', 'product_colors_relations', 'product_id', 'products', 'id');
	}
}
