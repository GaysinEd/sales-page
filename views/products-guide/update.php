<?php

use app\models\ProductsGuide;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var ProductsGuide $model */
/** @var app\models\Category[] $category */

$this->title = 'Изменить: ' . $model->name;         //?
$this->params['breadcrumbs'][] = ['label' => 'Список товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="products-guide-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
    ]) ?>

</div>