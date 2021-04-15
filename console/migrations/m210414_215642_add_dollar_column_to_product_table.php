<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m210414_215642_add_dollar_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
	public function up()
	{
		$this->addColumn('products', 'dollar_price', $this->integer(11)->after('price'));
	}
}
