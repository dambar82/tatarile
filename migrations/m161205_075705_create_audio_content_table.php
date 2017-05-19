<?php

use yii\db\Migration;

class m161205_075705_create_audio_content_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('audio_content', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer() . ' NOT NULL',
            'filename' => $this->string() . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('audio_content');
    }
}
