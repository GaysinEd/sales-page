<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\rest\ActiveController;

class ApiReceiptController extends ActiveController
{
    public $modelClass = '\app\models\Receipt';

    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
}