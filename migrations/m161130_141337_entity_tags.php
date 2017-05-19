<?php

use yii\db\Migration;
use yii\db\Schema;

class m161130_141337_entity_tags extends Migration
{
    public function safeUp()
    {
        $this->renameTable('article_tags','entity_tags');
        $this->renameColumn('entity_tags','article_id','entity_id');
        $this->addColumn('entity_eav','entity_type',Schema::TYPE_STRING . '(50) NOT NULL DEFAULT \'\'');
    }

    public function safeDown()
    {
        $this->renameTable('entity_tags','article_tags');
        $this->renameColumn('article_tags','entity_id','article_id');
        $this->dropColumn('entity_eav','entity_type');
    }
}
