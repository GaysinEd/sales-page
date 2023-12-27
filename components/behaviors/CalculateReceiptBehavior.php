<?php

namespace app\components\behaviors;

use app\models\Receipt;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;

class CalculateReceiptBehavior extends Behavior
{
    public function events(): array
    {
        return [
            BaseActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            BaseActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    public function afterInsert()
    {
        $model = $this->owner;
        if ($model instanceof Receipt) {
            $productsGuide = $model->product;
            $productsGuide->quantity_product_in_stock += $model->quantity;
            $productsGuide->save();
        }
    }

    public function beforeUpdate()
    {
        $model = $this->owner;
        if ($model instanceof Receipt) {
            $newQuantity   = $model->attributes['quantity'];
            $oldQuantity   = $model->oldAttributes['quantity'];
            $quantityDiff  = $newQuantity - $oldQuantity;
            $productsGuide = $model->product;
            $productsGuide->quantity_product_in_stock += $quantityDiff;
            $productsGuide->save();
        }
    }

    public function afterDelete()
    {
        $model = $this->owner;
        if ($model instanceof Receipt) {
            $productsGuide = $model->product;
            $productsGuide->quantity_product_in_stock -= $model->quantity;
            $productsGuide->save();

            $model->deleted_at = date('Y-m-d H:i:s');
            $model->save();
        }
    }
}