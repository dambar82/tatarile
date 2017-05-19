<?php

use yii\db\Migration;

class m161201_140444_entity_table extends Migration
{

    public function safeUp()
    {
        $this->update('entity',['entity_type_id' => 1]);
    }

    public function safeDown()
    {
        $this->update('entity',['entity_type_id' => 0]);
    }
}
