<?php

use yii\db\Migration;

class m161201_114913_entity_property_remove_entity_type extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('entity_property','entity_type');
    }

    public function safeDown()
    {
    }
}
