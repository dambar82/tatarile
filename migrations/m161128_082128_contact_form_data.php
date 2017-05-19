<?php

use yii\db\Migration;
use yii\db\Schema;

class m161128_082128_contact_form_data extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%contact_form_data}}', [
            'id' => Schema::TYPE_PK,
            'date_update' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_create' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . '(1) NOT NULL',
            'name' => Schema::TYPE_STRING .  '(255) NOT NULL DEFAULT \'\'',
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'subject' => Schema::TYPE_STRING . '(255) NOT NULL DEFAULT \'\'',
            'body' => Schema::TYPE_TEXT . ' NOT NULL'
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%contact_form_data}}');
    }
}
