<?php

use yii\db\Migration;

class m161221_103543_newcolumn_entity_comments extends Migration
{
    public function safeUp()
    {
        $this->addColumn('entity','comments',\yii\db\mysql\Schema::TYPE_TEXT);
    }

    public function safeDown()
    {
        $this->dropColumn('entity','comments');
    }
}
