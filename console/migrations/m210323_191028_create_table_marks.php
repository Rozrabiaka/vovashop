<?php

use yii\db\Migration;

/**
 * Class m210323_191028_create_table_marks
 */
class m210323_191028_create_table_marks extends Migration
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

		$this->createTable('{{%marks}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull()->unique(),
		], $tableOptions);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		echo "m210323_191028_create_table_marks cannot be reverted.\n";

		return false;
	}
}
