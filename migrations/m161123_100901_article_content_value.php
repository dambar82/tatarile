<?php

use yii\db\Migration;
use yii\db\Schema;

class m161123_100901_article_content_value extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article_content_value}}', [
            'id' => Schema::TYPE_PK,
            'content_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'value' => Schema::TYPE_TEXT,
            'lang_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%article_content_value}}');
    }
}
