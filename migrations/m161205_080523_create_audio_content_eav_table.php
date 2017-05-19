<?php

use yii\db\Migration;

class m161205_080523_create_audio_content_eav_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('audio_content_eav', [
            'id' => $this->primaryKey(),
            'audio_content_id' => $this->integer() . ' NOT NULL',
            'lang_id' => $this->integer() . ' NOT NULL',
            'title' => $this->string(),
            'description' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('audio_content_eav');
    }
}
