<?php

namespace app\models;

use yii\db\ActiveRecord;

class Provider extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'provider';
    }


    public function rules(): array
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['inn'],  'integer', 'min' => 0],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id' => 'id',
            'name' => 'Наименование поставщика',
            'inn' => 'ИНН',
        ];
    }
}