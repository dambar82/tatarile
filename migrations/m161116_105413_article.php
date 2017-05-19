<?php

use yii\db\Migration;
use yii\db\Schema;

class m161116_105413_article extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article}}', [
            'id' => Schema::TYPE_PK,
            'date_create' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_update' => Schema::TYPE_INTEGER . ' NOT NULL',
            'active' => Schema::TYPE_INTEGER,
            'user' => Schema::TYPE_INTEGER . ' NOT NULL',
            'corrector' => Schema::TYPE_STRING,
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
