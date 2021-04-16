<?php

use yii\db\Migration;

/**
 * Class m210416_115742_table_subcategories
 */
class m210416_115742_table_subcategories extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%subcategories}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
		], $tableOptions);
	}
}
