<?php

use yii\db\Migration;

class m161216_101524_create_entity_calendar_table extends Migration
{

    public function up()
    {
        $this->createTable('entity_calendar', [
            'id' => $this->primaryKey(),
            'date' => $this->integer(),
            'entity_id' => $this->integer(),
            'entity_type' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('entity_calendar');
    }
}
