<?php

use yii\db\Migration;

/**
 * Class m210323_194439_create_table_product_images
 */
class m210323_194439_create_table_product_images extends Migration
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

		$this->createTable('{{%products_image}}', [
			'id' => $this->primaryKey(),
			'product_id' => $this->integer()->notNull(),
			'image_path' => $this->text()->notNull()
		], $tableOptions);

		$this->addForeignKey('fk_products_image', 'products_image', 'product_id', 'products', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210323_194439_create_table_product_images cannot be reverted.\n";

        return false;
    }
}
