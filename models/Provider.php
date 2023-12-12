<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property Receipt[] $receipt поступления
 */

class Provider extends BaseModel
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
            'id'   => 'id',
            'name' => 'Поставщик',
            'inn'  => 'ИНН',
        ];
    }

    public function getReceipt(): ActiveQuery
    {
        return $this->hasMany(Receipt::class, ['provider_id' => 'id']);
    }


}