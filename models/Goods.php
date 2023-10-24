<?php

namespace app\models;

use yii\db\ActiveRecord;

class Goods extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @return string название таблицы, сопоставленной с этим ActiveRecord-классом.
     */
    public static function tableName()
    {
        return '{{goods}}';
    }
//    public static function tableName()
//    {
//        return 'goods';
//    }
}