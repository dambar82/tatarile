<?php

use yii\db\Migration;

class m161201_113154_remove_entity_type extends Migration
{

    public function safeUp()
    {
        $this->dropColumn('entity_eav','entity_type');
        $this->dropColumn('entity_eav_article','entity_type');
        $this->dropColumn('entity_eav_audio','entity_type');
        $this->dropColumn('entity_eav_video','entity_type');
    }

    public function safeDown()
    {

    }
}
