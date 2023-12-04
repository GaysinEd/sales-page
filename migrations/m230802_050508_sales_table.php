<?php

use yii\db\Migration;

/**
 * Class m230802_050508_sales_table
 */
class m230802_050508_sales_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('sales_table',[
            'id'           => $this->primaryKey(),
            'product_id'   => $this->integer()->comment('id_товара'),
            'price'        => $this->double()->comment('цена'),
            'quantity'     => $this->integer()->comment('количество'),
            'manager_id'   => $this->integer()->comment('id_продавца'),
            'time_of_sale' => $this->dateTime()->comment('время продажи'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('sales_table');
    }

}
