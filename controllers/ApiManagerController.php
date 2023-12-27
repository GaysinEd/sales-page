<?php

namespace app\controllers;

use app\models\Manager;
use yii\rest\ActiveController;

class ApiManagerController extends ActiveController
{
    public $modelClass = Manager::class;

}

