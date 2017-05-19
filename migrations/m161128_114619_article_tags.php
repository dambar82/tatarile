<?php

use yii\db\Migration;
use yii\db\Schema;

class m161128_114619_article_tags extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article_tags}}', [
            'id' => Schema::TYPE_PK,
            'tag' => Schema::TYPE_STRING . ' NOT NULL',
            'article_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'lang_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%article_tags}}');
    }
}
