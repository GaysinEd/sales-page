<?php

namespace app\controllers;

use yii\web\Controller;

class MyController extends Controller
{
    public function actionIndex($id ): string
    {
        $hi = 'Hello World!';
        $names = ['Ivanov', 'Petrov', 'Sidorov'];
//        return $this->render('index',[
//            'hello' => $hi,
//            'names'  => $names,
//        ]);

        // или

        return $this->render('index', compact('hi', 'names', 'id'));
    }
}