<?php

namespace app\controllers;

use app\models\Sales;
use Yii;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class ApiSalesController extends ActiveController
{
    public $modelClass = '\app\models\Sales';

}