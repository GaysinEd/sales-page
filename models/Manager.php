<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int         $id
 * @property string|null $surname           Фамилия
 * @property string|null $name              Имя
 * @property string|null $patronymic        Отчество
 * @property string      $shortName         Фамилия и инициалы
 * @property string      $fullName          Полное ФИО
 * @property Sales[]     $sales             Продажи
 * @property int         $managerIdLastSale Id менеджера совершившего последнюю продажу
 */
class Manager extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'manager';
    }

    public function rules(): array
    {
        return [
            [['surname', 'name', 'patronymic'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'         => 'id',
            'surname'    => 'Фамилия',
            'name'       => 'Имя',
            'patronymic' => 'Отчество',
        ];
    }

    public function getFullName(): string
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }

    public function getShortName(): string
    {
        return $this->surname . ' ' . mb_substr($this->name, 0, 1) . '.' . mb_substr($this->patronymic, 0, 1);
    }

    public function getSales(): ActiveQuery
    {
        return  $this->hasMany(Sales::class, ['manager_id' => 'id']);
    }


}
