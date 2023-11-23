<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\validators\QuantityValidator;

/**
 * Это класс модели для таблицы "Sales".
 *
 * @property int             $id
 * @property int             $product_id         id_товара
 * @property double          $price              цена
 * @property int             $quantity           количество
 * @property int             $manager_id         id_продавца
 * @property string          $time_of_sale       время продажи
 * @property Manager         $manager            ФИО менеджерa
 * @property ProductsGuide   $product            информация о продукте
 * @property string          $quantityValidator  валидатор количества продаваемого товара
 * @property Receipt[]       $receipt            поступления товара
 * @property string          $priceValidator     валидатор стоимости продаваемого товара
 **/

class Sales extends ActiveRecord
{
    const EVENT_AFTER_INSERT = 'afterInsert';

    public static function tableName(): string
    {
        return 'sales';
    }

    public function rules(): array
    {
        return [
            [['id', 'product_id', 'manager_id'],                'integer'],
            [['price'],                                         'double',    'min' => 0.01],
            [['quantity'],                                      'integer',   'min' => 0],
            [['time_of_sale'],                                  'string',    'max' => 255],
            [['product_id', 'manager_id', 'price', 'quantity'], 'required'],
            [['price', 'quantity'], 'trim'],
            ['quantity', QuantityValidator::class],
//            ['quantity', 'quantityValidator'],
            ['price', 'priceValidator'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'           => 'id',
            'price'        => 'Цена',
            'product_id'   => 'Товар',
            'quantity'     => 'Количество',
            'manager_id'   => 'Продавец',
            'time_of_sale' => 'Время продажи',
        ];
    }

    public function getManager(): ActiveQuery
    {
        return $this->hasOne(Manager::class, ['id' => 'manager_id']);
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(ProductsGuide::class, ['id' => 'product_id']);
    }

    public function getReceipt(): ActiveQuery
    {
        return $this->hasMany(Receipt::class, ['product_id' => 'product_id']);       //верно ли что hasMany ?
    }

    public function init()
    {
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'handleAfterInsert']);
    }

    public function handleAfterInsert($event)
    {
        $modelSales    = $event->sender;
        $productsGuide = ProductsGuide::findOne($modelSales->product_id);

        if($productsGuide)
        {
            $newQuantity = $productsGuide->quantity_product_in_stock - $modelSales->quantity;
            $productsGuide->quantity_product_in_stock = $newQuantity;
            $productsGuide->save();
        }
    }

    public function quantityValidator($value)
    {
        $product   = $this->product;
        $remainder = $product->remainder;

        if ($this->quantity > $remainder) {
            $this->addError($value, 'столько нет в наличии');
        }
    }

    public function priceValidator($value)
    {
        $product                = $this->product;
        $avgPriceReceiptProduct = $product->avgPriceReceiptProduct;

        if ($this->price < $avgPriceReceiptProduct) {
            $this->addError($value, 'Цена ниже закупочной');
        }
    }
}


