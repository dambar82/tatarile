<?php

use yii\db\Migration;

class m161213_120956_create_entity_related_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('entity_related', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'related_entity_id' => $this->integer()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('entity_related');
    }
}
