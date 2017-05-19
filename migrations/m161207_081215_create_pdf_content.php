<?php

use yii\db\Migration;

class m161207_081215_create_pdf_content extends Migration
{
    public function safeUp()
    {
        $this->createTable('pdf_content', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer() . ' NOT NULL',
            'filename' => $this->string() . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('pdf_content');
    }
}
