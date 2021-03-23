<?php

use yii\db\Migration;

/**
 * Class m210323_174743_create_table_subcategories
 */
class m210323_174743_create_table_subcategories extends Migration
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
			'name' => $this->string()->notNull()->unique(),
			'category_id' => $this->integer()->notNull()
		], $tableOptions);

		$this->addForeignKey('fk_subcategories', 'subcategories', 'category_id', 'categories', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210323_174743_create_table_subcategories cannot be reverted.\n";

        return false;
    }
}
