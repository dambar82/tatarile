<?php

use yii\db\Migration;
use yii\db\Schema;

class m161130_133937_entity_property extends Migration
{
    public function safeUp()
    {
        $this->renameTable('article_property','entity_property');
        $this->addColumn('entity_property','entity_type',Schema::TYPE_STRING . '(50) NOT NULL DEFAULT \'\'');
        $this->update('entity_property',['entity_type' => 'article']);
    }

    public function safeDown()
    {
        $this->renameTable('entity_property','article_property');
        $this->dropColumn('article_property','entity_type');
    }
}
