<?php

use yii\db\Migration;

class m161201_111254_entity_property_change extends Migration
{
    public function safeUp()
    {
        $this->addColumn('entity_property','entity_type_id',\yii\db\mysql\Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT \'0\'');
        $this->update('entity_property',['entity_type_id' => 1]);
    }

    public function safeDown()
    {
        $this->dropColumn('entity_property','entity_type_id');
    }
}
