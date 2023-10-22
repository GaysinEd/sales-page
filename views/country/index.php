<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Country;

// изменяет данные в БД
//    $countries = Country::find()->orderBy('name')->all();
//    $country = Country::findOne('US');
//    $country->name = 'U.S.A';
//    $country->save();

?>
<h1>Countries</h1>
<ul>
    <?php foreach ($countries as $country): ?>
        <li>
            <?= Html::encode("{$country->code} ({$country->name})") ?>:
            <?= $country->population ?>
        </li>
    <?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination,
    'maxButtonCount' => 5,
    'activePageCssClass' => 'active',
    'linkContainerOptions' => ['class' => 'page-item'],
    'linkOptions' => ['class' => 'page-link'],
    'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],
]) ?>

