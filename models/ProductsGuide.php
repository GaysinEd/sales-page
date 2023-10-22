<?php

namespace app\models;

use yii\data\Sort;
use yii\db\ActiveRecord;

/**
 * Это класс модели для таблицы "products_guide".
 *
 * @property int     $id                 id
 * @property string  $name               наименование
 * @property int     $price              цена
 * @property int     $quantity           количество
 * @property Sales[] $sales              продажи
 * @property int     $sumQuantityProduct суммарное кол-во продаж
 * @property int     $sumPriceProduct    суммарная цена продаж
 * @property string  $timeLastSale       время последней продажи
 * @property Sales   $lastSale           последняя продажа
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
            [['price'],    'double',  'min'  => 0.01],
            [['quantity'], 'integer', 'min'  => 0],
            [['name'],     'string',  'max'  => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'       => 'id',
            'name'     => 'Наименование',
            'price'    => 'Цена',
            'quantity' => 'Количество',
        ];
    }

    public function getSales(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Sales::class, ['product_id' => 'id']);
    }



//    public function getSumPriceProduct(): float|int
//    {
//        $sum = 0;
//        $sales = $this->sales;
//        foreach ($sales as $sale)
//        {
//            $sum += $sale->price * $sale->quantity;
//        }
//        return $sum;
//    }


//    public function getSumPriceProduct(): float|int
//    {
//        $sum = 0;
//        $sales = $this->sales;
//        foreach ($sales as $sale) {
//            $sum += $sale->getSumPriceSale();
//        }
//        return $sum;
//    }

    public function getSumPriceProduct(): bool|int|string|null
    {
        return $this->getSales()
            ->select('sum(price*quantity)')
            ->scalar();

    }


    public function getLastSale(): array|ActiveRecord|null
    {

         return $this->getSales()
            ->orderBy(['id' => SORT_DESC])
            ->one();

    }

    public function getSumQuantityProduct(): int
    {
        $count = 0;
        $sales = $this->sales;
        foreach ($sales as $sale) {
            $count += $sale->quantity;
        }
        return $count;
    }


    public function getTimeLastSale()
    {
        $sales = $this->sales;
        $lastSale = end($sales);
        return $lastSale->time_of_sale;
    }


//    public function getLastSale(): bool|Sales
//    {
//        $sales = $this->sales;
//        return end($sales);
//    }


//    public function getLastSale()
//    {
//        $sales[] = Sales::find()
//            ->select(['*'])
//            ->orderBy(['id' => SORT_DESC]);
//       //     ->one();
//        return array_shift($sales);
//    }


}

