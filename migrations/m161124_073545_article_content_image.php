<?php

use yii\db\Migration;
use yii\db\Schema;

class m161124_073545_article_content_image extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article_content_image}}', [
            'id' => Schema::TYPE_PK,
            'content_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'filename' => Schema::TYPE_STRING,
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%article_content_image}}');
    }
}
