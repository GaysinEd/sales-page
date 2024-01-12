<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;
use app\models\Manager;
use yii\web\YiiAsset;

/** @var View $this */
/** @var Manager $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продавцы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="manager-view">

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
            'surname',
            'name',
            'patronymic',
            ['attribute'=>'image_file',
            'value'=>'/web/uploads/' . $model->image_file,
            'format' => ['image',['width'=>100,'height'=>100]]],
        ],
    ]) ?>

</div>
