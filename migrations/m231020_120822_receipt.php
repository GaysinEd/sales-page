<?php

use yii\db\Migration;

/**
 * Class m231020_120822_receipt
 */
class m231020_120822_receipt extends Migration
{
    public function safeUp()
    {
        $this->createTable('receipt', [
            'id'              => $this->primaryKey(),
            'product_id'      => $this->integer()->comment('id_товара'),
            'provider_id'     => $this->integer()->comment('id_поставщика'),
            'price'           => $this->double()->comment('цена'),
            'quantity'        => $this->integer()->comment('количество'),
            'time_of_receipt' => $this->dateTime()->comment('время поступления товара'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('receipt');
    }
}
