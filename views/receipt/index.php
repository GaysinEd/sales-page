<?php

use app\models\Receipt;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Поступление товара';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receipt-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новое поступление', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'product_id',
                'label' => 'Продукт',
                'value' => function ($model) {
                    return $model->product->name ?? 'None';
                },
            ],
            [
                'attribute' => 'provider_id',
                'label' => 'Поставщик',
                'value' => function ($model) {
                    return $model->provider->name ?? 'None';
                },
            ],
            'price',
            'quantity',
            'time_of_receipt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Receipt $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
