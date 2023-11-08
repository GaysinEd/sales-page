<?php
namespace app\components;
use yii\validators\Validator;


class QuantityValidator extends Validator
{

    public function validateAttribute($model, $attribute)
    {

        $product   = $model->product;
        $remainder = $product->remainder;

        if ($model->quantity > $remainder) {
            $model->addError($attribute, 'столько нет в наличии');
        }




    }
}