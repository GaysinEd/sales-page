<?php

use yii\db\Migration;

/**
 * Class m230619_042440_products_guide
 */
class m230619_042440_products_guide extends Migration
{
    public function safeUp()
    {
        $this->createTable('products_guide', [
            'id'        => $this->primaryKey(),
            'name'      => $this->string()->comment('название товара'),
            'price'     => $this->integer()->comment('цена за штуку'),
            'quantity'  => $this->integer()->comment('количество'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('products_guide');
    }
}

