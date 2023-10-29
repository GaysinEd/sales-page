<?php

use app\models\ProductsGuide;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;


/** @var View                  $this */
/** @var ProductsGuide         $model */
/** @var ActiveForm            $form */
/** @var app\models\Category[] $category */


?>

<div class="products-guide-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')       ->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($category, 'id', 'name'), ['prompt' => 'Выберите категорию']) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php $form = ActiveForm::end(); ?>

</div>
