<?php

use yii\db\Migration;

/**
 * Class m231025_184119_remove_columns_from_the_products_guide
 */
class m231025_184119_remove_columns_from_the_products_guide extends Migration
{
        /**
        * {@inheritdoc}
        */
        public function safeUp(): void
        {
            $this->dropColumn('products_guide', 'price');
            $this->dropColumn('products_guide', 'quantity');
            $this->addColumn('products_guide',  'category_id', $this->integer()->comment('id_категории'));
        }

        /**
        * {@inheritdoc}
        */
        public function safeDown(): void
        {
            $this->addColumn('products_guide',  'price',    $this->double() ->comment('цена'));
            $this->addColumn('products_guide',  'quantity', $this->integer()->comment('количество'));
            $this->dropColumn('products_guide', 'category_id');

        }
}
