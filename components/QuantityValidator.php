<?php
namespace yii\validators;
use app\models\ProductsGuide;


class QuantityValidator extends Validator
{

    public function validateAttribute($model, $attribute)
    {
//        $product = ProductsGuide::findOne($model->product_id);
//        $remainder = $product->remainder;
//
//
//        if ($model->$attribute < $remainder) {
//            $this->addError($model, $attribute, 'столько нет в наличии');
//        }

//        $quantity = $model->$attribute;
//        $product = new ProductsGuide();
//        $remainder = $product->getRemainder();
//        if ($quantity < $remainder) {
//            $this->addError($model, $attribute, 'Нет в наличии');
//        }

//        $product = $model->product;
//        $remainder = $product->getRemainder();
//        if ($model->$attribute < $remainder) {
//            $this->addError($model, $attribute, 'столько нет в наличии');
//        }


        $value = $model->$attribute;
        $product = new ProductsGuide();
        $remainder = $product->remainder;

        if($value > $remainder){
            $this->addError($model, $attribute, 'Столько нет в наличии');
        }



    }
}