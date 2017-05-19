<?php

use yii\db\Migration;
use yii\db\Schema;

class m161128_115852_admin_action_statistics extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%admin_action_statistics}}', [
            'id' => Schema::TYPE_PK,
            'date_update' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_create' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . '(1) NOT NULL',
            'name' => Schema::TYPE_STRING .  '(255) NOT NULL DEFAULT \'\'',
            'count' => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT \'0\'',
            'views_count' => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT \'0\''
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%admin_action_statistics}}');
    }
}
