<?php

namespace app\models;

use yii\base\Model;

class User1 extends Model
{
    const USER_REGISTERED = 'Пользователь зарегистрирован';

    public function methodFromObject()
    {
        var_dump('Метод объекта передан');
    }

}

