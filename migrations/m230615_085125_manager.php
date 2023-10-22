<?php

use yii\db\Migration;

/**
 * Class m230615_085125_manager
 */
class m230615_085125_manager extends Migration
{

    public function safeUp()
    {
        $this->createTable('manager', [
            'id'         => $this->primaryKey(),
            'surname'    => $this->string()->comment('Фамилия'),
            'name'       => $this->string()->comment('Имя'),
            'patronymic' => $this->string()->comment('Отчество'),
        ]);

    }



    public function safeDown()
    {
       $this->dropTable('manager');
    }

}
