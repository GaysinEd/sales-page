<?php

use yii\helpers\Html;
use app\models\ProductsGuide;
use app\models\Provider;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */
/** @var ProductsGuide[] $productsGuide */
/** @var Provider[] $providers */

$this->title = 'Создать новое поступление';
$this->params['breadcrumbs'][] = ['label' => 'Поступление товара', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receipt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'         => $model,
        'productsGuide' => $productsGuide,
        'providers'     => $providers,
    ]) ?>

</div>
