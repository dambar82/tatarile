<?php

use yii\db\Migration;

class m170110_150440_add_entity_statistics_index extends Migration
{

    public function safeUp()
    {
        $this->createIndex("entity_id","entity_statistics",[
            "entity_id"
        ],true);
        $this->createIndex("points","entity_statistics",[
            "points"
        ]);
    }

    public function safeDown()
    {
    }
}
