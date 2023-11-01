<?php
namespace app\models;


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
 */
class Sales extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'sales';
    }

    public function rules(): array
    {
        return [
            [['id', 'product_id', 'manager_id'],                'integer'],
            [['price'],                                         'double',  'min' => 0.01],
            [['quantity'],                                      'integer', 'min' => 0],
            [['time_of_sale'],                                  'string',  'max' => 255],
            [['product_id', 'manager_id', 'price', 'quantity'], 'required'],
            [['price', 'quantity'], 'trim'],                                                  // для quantity не работает
//            ['quantity', validators\QuantityValidator::class],
            ['quantity', 'quantityValidator'],
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

    public function getManager(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Manager::class, ['id' => 'manager_id']);
    }

    public function getProduct(): \yii\db\ActiveQuery
    {
        return $this->hasOne(ProductsGuide::class, ['id' => 'product_id']);
    }

    public function quantityValidator($attribute)
    {
        $product   = $this->product;
        $remainder = $product->remainder;

        if ($this->quantity > $remainder) {
            $this->addError($attribute, 'столько нет в наличии');
        }
        
    }

    public function priceValidator($value)
    {
        $product                = $this->product;
        $avgPriceReceiptProduct = $product->avgPriceReceiptProduct;

        if($this->price < $avgPriceReceiptProduct){
            $this->addError($value, 'Цена ниже закупочной');
        }
    }

//    public function getQuantityValidator2()
//    {
//        $modelSales = new Sales();
//        $this->quantity = $modelSales->quantity;
//
//        $validator = new QuantityValidator();
//        $validator->validateAttribute($modelSales, 'quantity');
//
//
//    }







//   public function getManagerLastSale(): string
//    {
//////        $managers = $this->managers;             //??
//////        foreach ($managers as $manager)
//////        var_dump($manager);
//
//         return Manager::findOne(1)->shortName;     //норм
//
////          return Manager::findOne($this->manager_id)->where($this->time_of_sale)->max()->shortName;  //?
//
//////        return Manager::findOne(ProductsGuide::findOne($this->managerIdLastSale))->shortName; //?
////
//   }


}


