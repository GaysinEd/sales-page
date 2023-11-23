<?php

namespace app\controllers;

use Yii;
use app\models\Sales;
use yii\base\Event;
use yii\web\Controller;
use app\models\ProductsGuide;
use app\models\Manager;

class SalesController extends Controller
{
    public function actionIndex()
    {
        $productsGuide    = ProductsGuide::find()->all();
        $managers         = Manager::find()->all();

        $modelSales = new Sales();

        if ($modelSales->load(Yii::$app->request->post()) && $modelSales->validate()) {
            $modelSales->time_of_sale = date('Y-m-d H:i:s');
            if ($modelSales->save()) {
                    $this->trigger(Sales::EVENT_AFTER_INSERT,
                        new Event(['sender' => $modelSales]));
                return $this->refresh();
            }
        }

        return $this->render('index', [
            'productsGuide'      => $productsGuide,
            'managers'           => $managers,
            'modelSales'         => $modelSales,
            ]);
    }
}

