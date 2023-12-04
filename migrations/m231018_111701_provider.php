<?php

use yii\db\Migration;

/**
 * Class m231018_111701_provider
 */
class m231018_111701_provider extends Migration
{
    public function safeUp()
    {
        $this->createTable('provider', [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->comment('наименование поставщика'),
            'inn'  => $this->integer()->comment('инн'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('provider');
    }


}
