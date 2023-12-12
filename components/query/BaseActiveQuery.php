<?php

namespace app\components\query;

use yii\db\ActiveQuery;

class BaseActiveQuery extends ActiveQuery
{
    public $withDeleted;

    public function __construct($modelClass, $withDeleted = false, $config = [])
    {
        $this->withDeleted = $withDeleted;
        parent::__construct($modelClass, $config);
    }

    public function init()
    {
        $this->deletedFilter();
        parent::init();
    }
    public function deletedFilter(): BaseActiveQuery
    {
        $modelClass = $this->modelClass;
        $tableName  = $modelClass::tableName();

        if (!$this->withDeleted) {
            $this->andOnCondition(["$tableName.deleted_at" => null]);
        }

        return $this;
    }
}