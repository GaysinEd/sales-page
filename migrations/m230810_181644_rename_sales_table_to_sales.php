<?php

use yii\db\Migration;

/**
 * Class m230810_181644_rename_sales_table_to_sales
 */
class m230810_181644_rename_sales_table_to_sales extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('sales_table', 'sales');
    }


    public function safeDown()
    {
        $this->renameTable('sales', 'sales_table');
    }

}