<?php

use yii\helpers\Html;
use app\models\ProductsGuide;
use app\models\Provider;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */
/** @var ProductsGuide[] $productsGuide */
/** @var Provider[] $providers */

$this->title = 'Изменить: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Поступление товара', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="receipt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'         => $model,
        'productsGuide' => $productsGuide,
        'providers'     => $providers,
    ]) ?>

</div>
