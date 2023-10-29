<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Receipt $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Поступление товара', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="receipt-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'product_id',
                'value' => function ($model) {
                    return $model->product->name ?? 'None';
            },
            ],
            [
                'attribute' => 'provider_id',
                'value' => function ($model) {
                    return $model->provider->name ?? 'None';
                },
            ],
            'price',
            'quantity',
            'time_of_receipt',
        ],
    ]) ?>

</div>
