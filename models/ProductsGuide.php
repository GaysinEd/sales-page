<?php

namespace app\models;

use yii\data\Sort;
use yii\db\ActiveRecord;

/**
 * Это класс модели для таблицы "products_guide".
 *
 * @property int       $id                         id
 * @property string    $name                       наименование товара
 * @property double    $avg_price_receipt_product  средняя цена поступлений товара
 * @property int       $quantity_product_in_stock  количество товара на складе
 * @property Sales[]   $sales                      продажи
 * @property int       $sumQuantitySaleProduct     суммарное кол-во продаж товара
 * @property int       $sumPriceSaleProduct        суммарная цена продаж товара
 * @property string    $timeLastSale               время последней продажи твоара
 * @property Sales     $lastSale                   последняя продажа
 * @property int       $sumQuantityReceipt         суммарное кол-во поступлений товара
 * @property int       $remainder                  остаток товара
 * @property Receipt[] $receipt                    поступления
 * @property float     $avgPriceReceiptProduct     средняя цена поступлений товара
 *
 */

class ProductsGuide extends ActiveRecord

{
    public static function tableName(): string
    {
        return 'products_guide';
    }

    public function rules(): array
    {
        return [
            [['name'],                                                'string',  'max'  => 255],
            [['avg_price_receipt_product'],                           'double'],
            [['category_id', 'quantity_product_in_stock'],'integer'],
            [['name', 'category_id'],                                 'required'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'          => 'id',
            'name'        => 'Товар',
            'category_id' => 'Категория',
        ];
    }

    public function getSales(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Sales::class, ['product_id' => 'id']);
    }

    public function getCategory(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getReceipt(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Receipt::class, ['product_id' => 'id']);
    }


    public function getSumPriceSaleProduct()
    {
        return $this->getSales()
            ->select('sum(price*quantity)')
            ->scalar();

    }

    public function getLastSale()
    {
         return $this->getSales()                         // до сих пор ли это объект?
            ->orderBy(['id' => SORT_DESC])
            ->one();
    }


    public function getSumQuantitySaleProduct(): int
    {
        return $this->getSales()
            ->select('sum(quantity)')
            ->scalar();
    }


    public function getTimeLastSale()
    {
        return $this->getSales()
            ->select('time_of_sale')
            ->orderBy(['id' => SORT_DESC])
            ->scalar();
    }



//    public function getTimeLastSale()
//    {
//        return $this->getSales()
//            ->select('time_of_sale')
//            ->orderBy(['id' => SORT_DESC])          //Почему не работает?
//            ->one();
//    }

    public function getSumQuantityReceipt()
    {
        return $this->getReceipt()
            ->select('sum(quantity)')
            ->scalar();
    }

    public function getRemainder(): int
    {
        return $this->sumQuantityReceipt - $this->sumQuantitySaleProduct;
    }

    public function getAvgPriceReceiptProduct(): float
    {
        return round($this->getReceipt()
            ->select('(sum(price*quantity))/(sum(quantity))')
            ->scalar(), 2);
    }


}
