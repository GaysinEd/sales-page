<?php

use app\models\Manager;
use yii\helpers\Html;
use yii\web\View;


/** @var View $this */
/** @var Manager $model */

$this->title = 'Изменить: ' . $model->name;   //?
$this->params['breadcrumbs'][] = ['label' => 'Продавцы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="manager-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
