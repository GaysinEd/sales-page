<?php

use app\models\Sales;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Manager;
use app\models\ProductsGuide;
use yii\web\View;
use yii\grid\GridView;


/** @var View            $this */
/** @var Manager[]       $managers  */
/** @var ProductsGuide[] $productsGuide */
/** @var Sales[]         $sales */
/** @var ActiveForm      $form */
/** @var Sales           $modelSales */
/** @var GridView        $dataProvider */
/** @var Sales           $product */
/** @var Manager         $modelManager */





//      foreach ($managers as $manager) {
//          echo print_r($manager) . '<br>';
//    }

//echo $product->price;

//print_r($salesName);
//echo count($salesName->name);

//print_r($productsAndPrice);
//echo '<br>';
//
//
//
//foreach ($managers as $manager) {
////        echo $manager->getFullName() . '<br>';
//       echo $manager->getShortName() . '<br>';
//    }


//    echo print_r($productsAndPrice) . '<br>';
//foreach ($productsAndPrice as $value)
//{
//   echo print_r($value) . '<br>';                       //  1 ???
//}


// $name = 'OPG';     ?????
// echo $name;

//$x = 5+2;
//$x *=2;
//$x +=2;
//echo $x;


//      foreach ($productsGuide as $prod) {
//          echo print_r($prod) . '<br>';
//      }

//    echo '<pre>';
//    print_r($sales);
//    echo '</pre>';
//    exit();


?>


<table class="table table-bordered">
    <tr>
        <th>Наименование товара</th>
        <th>Суммарная цена всех проданных товаров данного типа</th>
        <th>Суммарное количество проданных товаров данного типа</th>
        <th>Дата продажи последнего товара</th>
        <th>ФИО продавца продавшего последний товар</th>
    </tr>
    <?php foreach ($productsGuide as $product): ?>
        <tr>
            <td><?= $product->name ?></td>
            <td><?= $product->sumPriceProduct ?></td>
            <td><?= $product->sumQuantityProduct ?></td>
            <td><?= $product->timeLastSale ?? 'None' ?></td>
<!--            <td>--><?php //= $modelManager->getShortName() ?? 'None' ?><!--</td>-->
<!--            <td>--><?php //= $modelSales->getManagerLastSale() ?? 'None' ?><!--</td>-->
<!--            <td>--><?php //= $modelSales->getManagerLastSale() ?? 'None' ?><!--</td>-->
            <td><?= $product->lastSale->manager->shortName ?? 'None' ?></td>
<!--            <td>--><?php //= $product->lastSale->manager->shortName ?? 'None' ?><!--</td>-->
        </tr>
    <?php endforeach; ?>
</table>

    <?= $this->render('_form', [
        'productsGuide'  =>$productsGuide,
        'managers'       => $managers,
        'modelSales'     => $modelSales,
        //'dataProvider'   => $dataProvider,
    ]) ?>




