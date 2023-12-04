<?php

use yii\db\Migration;

/**
 * Class m231203_144737_add_foreign_key_and_index_to_the_sales_and_receipt
 */
class m231203_144737_add_foreign_key_and_index_to_the_sales_and_receipt extends Migration
{
    public function safeUp()
    {
        $this->createIndex(
            'idx-sales-product_id',
            'sales',
            'product_id',
        );

        $this->addForeignKey(
            'fk-sales-product_id',
            'sales',
            'product_id',
            'products_guide',
            'id',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-sales-manager_id',
            'sales',
            'manager_id',
        );

        $this->addForeignKey(
            'fk-sales-manager_id',
            'sales',
            'manager_id',
            'manager',
            'id',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-receipt-product_id',
            'receipt',
            'product_id',
        );

        $this->addForeignKey(
            'fk-receipt-product_id',
            'receipt',
            'product_id',
            'products_guide',
            'id',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-receipt-provider_id',
            'receipt',
            'provider_id',
        );

        $this->addForeignKey(
            'fk-receipt-provider_id',
            'receipt',
            'provider_id',
            'provider',
            'id',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-sales-product_id',
            'sales'
        );

        $this->dropIndex(
            'idx-sales-product_id',
            'sales'
        );

        $this->dropForeignKey(
            'fk-sales-manager_id',
            'sales'
        );

        $this->dropIndex(
            'idx-sales-manager_id',
            'sales'
        );

        $this->dropForeignKey(
            'fk-receipt-product_id',
            'receipt'
        );

        $this->dropIndex(
            'idx-receipt-product_id',
            'receipt'
        );

        $this->dropForeignKey(
            'fk-receipt-provider_id',
            'receipt'
        );

        $this->dropIndex(
            'idx-receipt-provider_id',
            'receipt'
        );
    }
}
