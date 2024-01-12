<?php

namespace app\models;

use app\components\behaviors\MarkDeletedAtBehavior;
use yii\db\ActiveQuery;

/**
 * @property int         $id
 * @property string|null $surname           Фамилия
 * @property string|null $name              Имя
 * @property string|null $patronymic        Отчество
 * @property string      $shortName         Фамилия и инициалы
 * @property string      $fullName          Полное ФИО
 * @property Sales[]     $sales             Продажи
 * @property int         $managerIdLastSale id менеджера совершившего последнюю продажу
 * @property string      $deleted_at        дата удаления
 * @property string      $image_file        изображение
 */
class Manager extends BaseModel
{
    public $imageFile;

    public static function tableName(): string
    {
        return 'manager';
    }

    public function rules(): array
    {
        return [
            [['surname', 'name', 'patronymic'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['surname', 'name', 'patronymic'], 'required'],
            [['deleted_at'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'         => 'id',
            'surname'    => 'Фамилия',
            'name'       => 'Имя',
            'patronymic' => 'Отчество',
            'image_file' => 'Изображение',
        ];
    }

    public function behaviors(): array
    {
        return [
            'markDeletedAtBehavior' => [
                'class' => MarkDeletedAtBehavior::class,
            ]
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

    public function upload(): bool
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
