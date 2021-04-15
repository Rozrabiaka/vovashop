<?php

use yii\db\Migration;

/**
 * Class m210414_212810_course_to_product
 */
class m210414_212810_course_to_product extends Migration
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

		$this->createTable('{{%course_dollar}}', [
			'id' => $this->primaryKey(),
			'course' => $this->float()->notNull(),
		], $tableOptions);
	}
}
