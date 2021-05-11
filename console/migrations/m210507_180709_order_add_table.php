<?php

use yii\db\Migration;

/**
 * Class m210507_180709_order_add_table
 */
class m210507_180709_order_add_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('orders', 'first_name', $this->string()->after('date'));
        $this->addColumn('orders', 'last_name', $this->string()->after('date'));
    }
}
