<?php

use yii\db\Migration;

class m161221_082340_add_new_column_on_entity_statistics_table extends Migration
{

    public function safeUp()
    {
        $this->addColumn('entity_statistics','points',\yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'');
    }

    public function safeDown()
    {
        $this->dropColumn('entity_statistics','points');
    }
}
