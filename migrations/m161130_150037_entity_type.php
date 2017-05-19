<?php

use yii\db\Migration;
use yii\db\Schema;

class m161130_150037_entity_type extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%entity_type}}', [
            'id' => Schema::TYPE_PK,
            'entity_type' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
            'class' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%entity_type}}');
    }
}
