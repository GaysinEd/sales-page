<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\components\query\BaseActiveQuery;


class BaseModel extends ActiveRecord
{
    public static function find($withDeleted = false): BaseActiveQuery
    {
        return new BaseActiveQuery(get_called_class(), $withDeleted);
    }
}