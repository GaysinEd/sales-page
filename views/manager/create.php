<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Manager $model */

$this->title = 'Создать продавца';
$this->params['breadcrumbs'][] = ['label' => 'Продавцы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
