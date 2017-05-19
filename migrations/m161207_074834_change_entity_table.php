<?php

use yii\db\Migration;

class m161207_074834_change_entity_table extends Migration
{

    public function safeUp()
    {
        $this->addColumn('entity','date_format', \yii\db\mysql\Schema::TYPE_INTEGER .'(1) NOT NULL DEFAULT \'1\'');
        $this->dropColumn('entity','event_date_begin');
        $this->dropColumn('entity','event_date_end');
        $this->addColumn('entity','event_date_begin', \yii\db\mysql\Schema::TYPE_BIGINT);
        $this->addColumn('entity','event_date_end', \yii\db\mysql\Schema::TYPE_BIGINT);
    }

    public function safeDown()
    {
    }
}
