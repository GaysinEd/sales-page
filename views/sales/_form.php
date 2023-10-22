<?php

use yii\grid\GridView;
use app\models\Sales;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Manager;
use app\models\ProductsGuide;
use yii\web\View;


/** @var View $this */
/** @var Manager[] $managers  */
/** @var ProductsGuide[] $productsGuide */
/** @var ActiveForm $form */
/** @var Sales $modelSales */
/** @var GridView $dataProvider */

//echo GridView::widget([
//    'dataProvider' => $dataProvider,
//    'columns' => [
//        'product_id',
//        'price',
//        'quantity',
//        'time_of_sale',
//        'manager_id',
//    ],
//])
?>


<div class="sales-list-form">
    <?php $form = ActiveForm::begin()?>
    <?= $form->field($modelSales, 'product_id')->dropDownList(ArrayHelper::map($productsGuide, 'id', 'name'), ['prompt' => 'Выберите товар']) ?>
    <?= $form->field($modelSales, 'price')->textInput(['type' => 'number', 'placeholder' => 'Введите цену товара']) ?>
    <?= $form->field($modelSales, 'quantity')->textInput(['maxlength' => true, 'placeholder' => 'Введите кол-во товара']) ?>
    <?= $form->field($modelSales, 'manager_id')->dropDownList(ArrayHelper::map($managers, 'id', 'shortName'), ['prompt' => 'Выберите продавца']) ?>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    <?php $form = ActiveForm::end()?>

</div>
