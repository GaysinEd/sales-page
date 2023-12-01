<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ProductsGuide;
use app\models\Provider;

/** @var yii\web\View           $this */
/** @var app\models\Receipt     $model */
/** @var yii\widgets\ActiveForm $form */
/** @var ProductsGuide[]        $productsGuide */
/** @var Provider[]             $providers */
?>

<div class="receipt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map($productsGuide, 'id', 'name'), ['prompt' => 'Выберите товар']) ?>

    <?= $form->field($model, 'provider_id')->dropDownList(ArrayHelper::map($providers, 'id', 'name'), ['prompt' => 'Выберите поставщика']) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
