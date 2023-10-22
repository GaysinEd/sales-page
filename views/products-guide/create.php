<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProductsGuide $model */

$this->title = 'Добавить товар';
$this->params['breadcrumbs'][] = ['label' => 'Список товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-guide-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>