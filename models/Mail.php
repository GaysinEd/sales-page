<?php

namespace app\models;

use yii\base\Model;

class Mail extends Model
{
    public static function staticMethod()
    {
        var_dump('Вернул статический метод');
    }

}