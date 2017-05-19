<?php

use yii\db\Migration;

class m161201_125222_entity_property_change extends Migration
{

    public function safeUp()
    {
        $this->addColumn('entity_property','name',\yii\db\mysql\Schema::TYPE_STRING . '(50) NOT NULL DEFAULT \'\'');
    }

    public function safeDown()
    {
        $this->dropColumn('entity_property','name');
    }
}
