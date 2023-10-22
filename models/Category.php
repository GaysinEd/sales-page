<?php

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'category';
    }


    public function rules(): array
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels(): array
    {
        return [
            'id'         => 'id',
            'name'       => 'Наименование категории',
        ];
    }
}