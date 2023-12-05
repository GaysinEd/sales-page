<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property string $name    наименование категории
 */
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
            'id'   => 'id',
            'name' => 'Наименование категории',
        ];
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(ProductsGuide::class,['category_id' => 'id']);
    }
}