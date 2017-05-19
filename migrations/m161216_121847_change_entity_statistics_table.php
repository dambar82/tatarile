<?php

use yii\db\Migration;

class m161216_121847_change_entity_statistics_table extends Migration
{

    public function safeUp()
    {
        $this->renameColumn('entity_statistics','views_count','viewing_count');
    }

    public function safeDown()
    {
        $this->renameColumn('entity_statistics','viewing_count','views_count');
    }
}
