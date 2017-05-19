<?php

use yii\db\Migration;

class m161216_093219_rename_entity_views_table extends Migration
{

    public function safeUp()
    {
        $this->renameTable('entity_views','entity_viewing');
    }

    public function safeDown()
    {
        $this->renameTable('entity_viewing','entity_views');
    }
}
