<?php

use yii\db\Migration;

class m161205_131945_create_video_content_table extends Migration
{


    public function safeUp()
    {
        $this->createTable('video_content', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer() . ' NOT NULL',
            'filename' => $this->string() . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('video_content');
    }
}
