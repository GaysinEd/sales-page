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
 * @property Sales[]         $sales             продажи
 */

class Receipt extends ActiveRecord
{
    const EVENT_AFTER_INSERT = 'afterInsert';
//    const EVENT_AFTER_UPDATE = 'afterUpdate';
    const EVENT_BEFORE_UPDATE = 'beforeUpdate';


    public static function tableName(): string
    {
        return 'receipt';
    }

    public function rules(): array
    {
        return [
            [['product_id', 'provider_id'],                      'integer'],
            [['price'],                                          'double', 'min' => 0.01],
            [['quantity'],                                       'integer', 'min' => 0],
            [['time_of_receipt'],                                'string', 'max' => 255],
            [['product_id', 'provider_id', 'price', 'quantity'], 'required'],
            ['product_id', 'exist', 'targetClass' => ProductsGuide::className(), 'targetAttribute' => 'id'],
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

    public function getSales(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Sales::class, ['product_id' => 'product_id']);       //верно ли что hasMany ?
    }

    public function init()
    {
        parent::init();
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'handleAfterInsert']);
//        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'afterUpdate']);
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'beforeUpdate']);
    }

//    public function afterUpdate()
//    {
//        $this->trigger(self::EVENT_AFTER_UPDATE);
//    }

//    public function handleAfterInsert()
//    {
//        $productsGuide = ProductsGuide::findOne($this->product_id);
//        $productsGuide->quantity_product_in_stock += $this->quantity;
//        $productsGuide->save();
//    }

    public function handleAfterInsert($event)
    {
        $model         = $event->sender;
        $productsGuide = ProductsGuide::findOne($model->product_id);

        if($productsGuide)
        {
            $newQuantity = $productsGuide->quantity_product_in_stock + $model->quantity;
            $productsGuide->quantity_product_in_stock = $newQuantity;
            $productsGuide->save();
        }
    }

    public function beforeUpdate($event)
    {
        $model = $event->sender;

        $oldQuantity = $model->oldAttributes['quantity'];
        $newQuantity = $model->attributes['quantity'];


//        $oldQuantity = $model->getOldAttribute('quantity');


//        $oldAttributes = $model->getAttributes($model->getDirtyAttributes());
//        $oldQuantity = $oldAttributes['quantity'];


        $product       = ProductsGuide::findOne($model->product_id);

        if ($product) {
            $quantityDiff = $newQuantity - $oldQuantity;
            $product->quantity_product_in_stock += $quantityDiff;
            $product->save();
        }

    }



}