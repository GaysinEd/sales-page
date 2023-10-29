<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use app\models\ProductsGuide;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\View;

/** @var View $this */
/** @var ActiveDataProvider $dataProvider */

$this->title = 'Список товаров';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="products-guide-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'category_id',
                'label'     => 'Категория',
                'value'     => function ($model) {
                    return $model->category->name ?? 'None';
                },
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, ProductsGuide $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>
