<?php

use yii\db\Migration;

class m161216_152530_add_column_entity_statistics extends Migration
{
    public function safeUp()
    {
        $this->addColumn('entity_statistics','unique_viewing_count',\yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'');
    }

    public function safeDown()
    {
        $this->dropColumn('entity_statistics','unique_viewing_count');
    }
}
