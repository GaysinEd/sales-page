<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Это класс модели для таблицы "Sales".
 *
 * @property int             $id
 * @property int             $product_id        id_товара
 * @property double          $price             цена
 * @property int             $quantity          количество
 * @property int             $provider_id       id_поставщика
 * @property string          $time_of_receipt   время продажи
 * @property ProductsGuide   $product           информация о продукте
 * @property Provider        $provider          информация о поставщике
 */

class Receipt extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'receipt';
    }

    public function rules(): array
    {
        return [
            [['id', 'product_id', 'provider_id'],                'integer'],
            [['price'],                                          'double', 'min' => 0.01],
            [['quantity'],                                       'integer', 'min' => 0],
            [['time_of_receipt'],                                'string', 'max' => 255],
            [['product_id', 'provider_id', 'price', 'quantity'], 'required'],
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

    public function getProduct(): \yii\db\ActiveQuery
    {
        return $this->hasOne(ProductsGuide::class,['id' => 'product_id']);
    }

    public function getProvider(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Provider::class,['id' => 'provider_id']);
    }

}