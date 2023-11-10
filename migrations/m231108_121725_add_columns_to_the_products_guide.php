<?php

use yii\db\Migration;

/**
 * Class m231108_121725_add_columns_to_the_products_guide
 */
class m231108_121725_add_columns_to_the_products_guide extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products_guide', 'quantity_product_in_stock', $this->integer()->comment('кол-во_товара_на_складе'));
        $this->addColumn('products_guide', 'avg_price_receipt_product', $this->double() ->comment('средняя_цена_поступлений_товара'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products_guide', 'quantity_product_in_stock');
        $this->dropColumn('products_guide', 'avg_price_receipt_product');

    }

}
