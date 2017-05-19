<?php

use yii\db\Migration;

class m161214_151926_drop_entity_subcategory_id extends Migration
{

    public function safeUp()
    {
        $this->dropColumn('entity','subcategory_id');
    }

    public function safeDown()
    {
    }
}
