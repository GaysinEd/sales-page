<?php

use yii\db\Migration;

/**
 * Class m231018_104529_category
 */
class m231018_104529_category extends Migration
{
    public function safeUp()
    {
        $this->createTable('category', [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->comment('категория'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('category');

    }
}
