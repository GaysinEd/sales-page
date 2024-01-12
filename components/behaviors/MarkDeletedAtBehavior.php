<?php

namespace app\components\behaviors;

use app\models\Manager;
use app\models\ProductsGuide;
use app\models\Receipt;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;

class MarkDeletedAtBehavior extends Behavior
{
    public function events(): array
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
        ];
    }

    public function beforeDelete()
    {
        $model = $this->owner;
        if ($model instanceof Receipt) {
            $model->deleted_at = date('Y-m-d H:i:s');
            $model->save();
        }

        if ($model instanceof Manager) {
            $model->deleted_at = date('Y-m-d H:i:s');
            $model->save();
        }

        if ($model instanceof ProductsGuide) {
            $model->deleted_at = date('Y-m-d H:i:s');
            $model->save();
        }
    }
}