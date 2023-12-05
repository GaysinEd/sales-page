<?php

use yii\db\Migration;

/**
 * Class m231204_130829_add_column_visible
 */
class m231204_130829_add_column_deleted_at extends Migration
{
    public function safeUp()
    {
        $this->addColumn('products_guide', 'deleted_at', $this->dateTime()->comment('дата удаления'));
        $this->addColumn('sales', 'deleted_at', $this->dateTime()->comment('дата удаления'));
        $this->addColumn('receipt', 'deleted_at', $this->dateTime()->comment('дата удаления'));
        $this->addColumn('manager', 'deleted_at', $this->dateTime()->comment('дата удаления'));
    }

    public function safeDown()
    {
        $this->dropColumn('products_guide', 'deleted_at');
        $this->dropColumn('sales', 'deleted_at');
        $this->dropColumn('receipt', 'deleted_at');
        $this->dropColumn('manager', 'deleted_at');
    }
}
