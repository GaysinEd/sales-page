<?php

namespace app\components\behaviors;

use app\models\Sales;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;

class CalculateSaleBehavior extends Behavior
{
    public function events(): array
    {
        return [
            BaseActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
        ];
    }

    public function afterInsert()
    {
        $model = $this->owner;
        if ($model instanceof Sales) {
            $productsGuide = $model->product;
            $newQuantity = $productsGuide->quantity_product_in_stock - $model->quantity;
            $productsGuide->quantity_product_in_stock = $newQuantity;
            $productsGuide->save();
        }
    }
}