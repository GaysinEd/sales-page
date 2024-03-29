<?php

namespace app\models;

use app\components\behaviors\CalculateReceiptBehavior;
use app\components\behaviors\MarkDeletedAtBehavior;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

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
 * @property int       $sumQuantityReceiptProduct  суммарное кол-во поступлений товара
 * @property int       $remainder                  остаток товара
 * @property Receipt[] $receipt                    поступления
 * @property float     $avgPriceReceiptProduct     средняя цена поступлений товара
 * @property string    $deleted_at                 дата удаления
 *
 */

class ProductsGuide extends BaseModel
{
    public static function tableName(): string
    {
        return 'products_guide';
    }

    public function extraFields()
    {
        return ArrayHelper::merge(parent::extraFields(),[
            'category',
        ]);
    }

    public function rules(): array
    {
        return [
            [['name'], 'string',    'max'  => 255],
            [['avg_price_receipt_product'], 'double'],
            [['category_id', 'quantity_product_in_stock'], 'integer'],
            [['name', 'category_id'], 'required'],
            [['deleted_at'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'                        => 'id',
            'name'                      => 'Товар',
            'category_id'               => 'Категория',
            'avg_price_receipt_product' => 'Средняя цена поступлений товара',
            'quantity_product_in_stock' => 'Количество товара на складе',
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

    public function getSales(): ActiveQuery
    {
        return $this->hasMany(Sales::class, ['product_id' => 'id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getReceipt(): ActiveQuery
    {
        return $this->hasMany(Receipt::class, ['product_id' => 'id']);
    }

    public function getSumPriceSaleProduct(): ?int
    {
        return $this->getSales()
            ->select('sum(price*quantity)')
            ->scalar();
    }

    public function getLastSale(): object
    {
         return $this->getSales()
            ->orderBy(['id' => SORT_DESC])
            ->one();
    }

    public function getSumQuantitySaleProduct(): ?int
    {
        return $this->getSales()
            ->select('sum(quantity)')
            ->scalar();
    }

    public function getTimeLastSale(): string
    {
        return $this->getSales()
            ->select('time_of_sale')
            ->orderBy(['id' => SORT_DESC])
            ->scalar();
    }

    public function getSumQuantityReceiptProduct(): ?int
    {
        return $this->getReceipt()
            ->select('sum(quantity)')
            ->scalar();
    }

    public function getRemainder(): int
    {
        if ($this->sumQuantityReceiptProduct != 'None' || $this->sumQuantityReceiptProduct > 0) {
            return $this->sumQuantityReceiptProduct - $this->sumQuantitySaleProduct;
        }else{
            return $this->sumQuantitySaleProduct;
        }
    }

    public function getAvgPriceReceiptProduct(): float
    {
        $avgPrice = $this->getReceipt()
            ->select('(sum(price*quantity))/(sum(quantity))')
            ->scalar() ?? 0;
        return round($avgPrice, 2);
    }
}
