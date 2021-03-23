<?php

use yii\db\Migration;

/**
 * Class m210323_172442_create_table_categories
 */
class m210323_172442_create_table_categories extends Migration
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

		$this->createTable('{{%categories}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull()->unique(),
		], $tableOptions);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		echo "m210323_172442_create_table_categories cannot be reverted.\n";

		return false;
	}

}
