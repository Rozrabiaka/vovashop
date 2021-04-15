<?php

use yii\db\Migration;

/**
 * Class m210415_124226_add_columns_to_product
 */
class m210415_124226_add_columns_to_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('products', 'color', $this->integer(11)->after('date'));//цвет
		$this->addForeignKey('fk_products_color', 'products', 'color', 'product_colors', 'id');

//		$this->addColumn('products', 'engine_volume', $this->integer(11)->after('date')); //обьем двигателя
//		$this->addColumn('products', 'engine_number', $this->integer(11)->after('date')); // номер двигателя
    }
}
