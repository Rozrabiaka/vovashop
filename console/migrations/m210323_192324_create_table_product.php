<?php

use yii\db\Migration;

/**
 * Class m210323_192324_create_table_products
 */
class m210323_192324_create_table_product extends Migration
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

		$this->createTable('{{%products}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'category_id' => $this->integer()->notNull(),
			'subcategory_id' => $this->integer()->null(),
			'price' => $this->integer()->notNull(),
			'qty' => $this->integer()->notNull(),
			'model' => $this->integer()->null(),
			'description' => $this->text()->notNull(),
			'product_status' => $this->smallInteger()->notNull()->defaultValue(0),
			'date' => $this->dateTime()->notNull(),
			'user_added' => $this->smallInteger()->notNull()
		], $tableOptions);

		$this->addForeignKey('fk_products_categories', 'products', 'category_id', 'categories', 'id');
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		echo "m210323_192324_create_table_product cannot be reverted.\n";

		return false;
	}
}
