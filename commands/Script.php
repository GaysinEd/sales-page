<?php

namespace app\commands;

use yii\console\Controller;
use app\models\ProductsGuide;

Class Script extends Controller
{
    public function actionCalculateTotalQuantity()
    {

    $products = ProductsGuide::find()->each();

        foreach ($products as $product) {
            if ($product instanceof ProductsGuide) {

                $sumQuantityReceiptProduct = $product->getSumQuantityReceiptProduct();

                $sumQuantitySaleProduct    = $product->getSumQuantitySaleProduct();

                $avgPriceReceiptProduct    = $product->getAvgPriceReceiptProduct();

                $product->quantity_product_in_stock = $sumQuantityReceiptProduct - $sumQuantitySaleProduct;
                $product->avg_price_receipt_product = $avgPriceReceiptProduct;

                $product->save();
            }
        }
    }
}

