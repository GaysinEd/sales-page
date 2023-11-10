<?php

namespace app\commands;

use yii\console\Controller;
use app\models\ProductsGuide;
use app\models\Receipt;

Class Script extends Controller
{


    public function actionCalculateTotalQuantity()
    {
        $products = ProductsGuide::find()->all();


        foreach ($products as $product)
        {
            $totalQuantity = intval(Receipt::find()
                ->where(['product_id' => $product->id])
                ->sum('quantity'));


            $avgPrice = round((new \yii\db\Query())
                ->select(['avgPrice' => new \yii\db\Expression('SUM(price*quantity)/SUM(quantity)')])
                ->from('receipt')
                ->where(['product_id' => $product->id])
                ->scalar(), 2);


            $product->quantity_product_in_stock = $totalQuantity;
            $product->avg_price_receipt_product = $avgPrice;

            $product->save();

        }

    }
}

