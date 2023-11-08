<?php

namespace app\commands;

use yii\console\Controller;
use app\models\ProductsGuide;
use app\models\Receipt;

Class Script extends Controller
{


    public function actionCalculateTotalQuantity()
    {
        $receipts = Receipt::find()->all();
        $totalQuantities = [];
       // var_dump($receipts);
//
//        foreach ($receipts as $receipt) {
//            $productId = $receipt->product_id;
//            $quantity = $receipt->quantity;
//        }
//
//        if (isset($totalQuantities[$productId])) {
//            $totalQuantities[$productId] += $quantity;
//
//        }else{
//            $totalQuantities[$productId] = $quantity;
//        }
//
//        foreach ($totalQuantities as $productId => $totalQuantity) {
//            $product = ProductsGuide::findOne($productId);
//            echo "Товар: {$product->name}, Общее количество: {$totalQuantity}\n";
//        }

    }
}

