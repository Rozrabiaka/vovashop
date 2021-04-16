<?php

use yii\db\Migration;

/**
 * Class m210416_120918_retalions_subcat_cat
 */
class m210416_120918_retalions_subcat_cat extends Migration
{
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%relations_category}}', [
			'id' => $this->primaryKey(),
			'subcategory' => $this->integer(11)->notNull(),
			'category' => $this->integer(11)->notNull(),
		], $tableOptions);

		$this->addForeignKey('fk_category_key', 'relations_category', 'category', 'categories', 'id');
		$this->addForeignKey('fk_subcategory_key', 'relations_category', 'subcategory', 'subcategories', 'id');
	}
}
