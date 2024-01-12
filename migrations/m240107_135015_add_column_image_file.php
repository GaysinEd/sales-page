<?php

use yii\db\Migration;

/**
 * Class m240107_135015_add_column_image_file
 */
class m240107_135015_add_column_image_file extends Migration
{
    public function safeUp()
    {
        $this->addColumn('manager', 'image_file', $this->string()->comment('изображение'));
    }

    public function safeDown()
    {
        $this->dropColumn('manager', 'image_file');
    }

}
