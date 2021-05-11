<?php

use yii\db\Migration;

/**
 * Class m210506_154118_orders
 */
class m210506_154118_orders extends Migration
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

        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'qty' => $this->integer()->notNull(),
            'order_number' => $this->string(20)->notNull(),
            'phone' => $this->string(20)->notNull(),
            'delivery_type' => $this->integer()->notNull(),
            'payment_type' => $this->integer()->notNull(),
            'address' => $this->string()->notNull(),
            'date' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP')
        ], $tableOptions);

        $this->addForeignKey('fk_orders_product_id', 'orders', 'product_id', 'products', 'id');
    }
}
