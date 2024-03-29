<?php

namespace app\models;

use app\components\behaviors\CalculateReceiptBehavior;
use app\components\behaviors\MarkDeletedAtBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * Это класс модели для таблицы "Поступления товара".
 *
 * @property int             $id
 * @property int             $product_id        id_товара
 * @property double          $price             цена
 * @property int             $quantity          количество
 * @property int             $provider_id       id_поставщика
 * @property string          $time_of_receipt   время продажи
 * @property ProductsGuide   $product           информация о продукте
 * @property Provider        $provider          информация о поставщике
 * @property Sales[]         $sales             продажи
 * @property string          $deleted_at        дата удаления
 * @property UploadedFile    $csvFile           csv файл
 */

class Receipt extends BaseModel
{
    public static function tableName(): string
    {
        return 'receipt';
    }

    public function extraFields()
    {
        return ArrayHelper::merge(parent::extraFields(),[
            'product',
            'provider',
        ]);
    }

    public function rules(): array
    {
        return [
            [['product_id', 'provider_id'], 'integer'],
            [['price'], 'double', 'min' => 0.01],
            [['quantity'], 'integer', 'min' => 0],
            [['time_of_receipt'], 'string', 'max' => 255],
            [['product_id', 'provider_id', 'price', 'quantity'], 'required'],
            ['product_id', 'exist', 'targetClass' => ProductsGuide::class, 'targetAttribute' => 'id'],
            [['deleted_at'], 'string', 'max' => 255],
//            [['csvFile'], 'file'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'              => 'id',
            'product_id'      => 'Товар',
            'provider_id'     => 'Постащик',
            'price'           => 'Цена',
            'quantity'        => 'Количество',
            'time_of_receipt' => 'Время поступления товара',
        ];
    }

    public function behaviors(): array
    {
        return [
            'calculateReceiptBehavior' => [
                'class' => CalculateReceiptBehavior::class,
            ],
            'markDeletedAtBehavior' => [
                'class' => MarkDeletedAtBehavior::class,
            ]
        ];
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(ProductsGuide::class,['id' => 'product_id']);
    }

    public function getProvider(): ActiveQuery
    {
        return $this->hasOne(Provider::class,['id' => 'provider_id']);
    }

}