<?php

use yii\db\Migration;

/**
 * Class m231204_130829_add_column_visible
 */
class m231204_130829_add_column_visible extends Migration
{
    public function safeUp()
    {
        $this->addColumn('products_guide', 'visible', $this->tinyInteger(1)->comment('отметка на удаление'));
        $this->addColumn('sales', 'visible', $this->tinyInteger(1)->comment('отметка на удаление'));
        $this->addColumn('receipt', 'visible', $this->tinyInteger(1)->comment('отметка на удаление'));
        $this->addColumn('manager', 'visible', $this->tinyInteger(1)->comment('отметка на удаление'));
    }

    public function safeDown()
    {
        $this->dropColumn('products_guide', 'visible');
        $this->dropColumn('sales', 'visible');
        $this->dropColumn('receipt', 'visible');
        $this->dropColumn('manager', 'visible');
    }
}
