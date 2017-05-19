<?php

use yii\db\Migration;
use yii\db\Schema;

class m161122_073659_table_images extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%images}}', [
            'id' => Schema::TYPE_PK,
            'article_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'filename' => Schema::TYPE_STRING . ' NOT NULL',
            'alt' => Schema::TYPE_STRING,
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%images}}');
    }
}
