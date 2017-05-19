<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m161214_121634_subcategory_table_create extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%entity_subsubject_eav}}', [
            'id' => Schema::TYPE_PK,
            'entity_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'subject_id' => Schema::TYPE_INTEGER . ' NOT NULL'
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%entity_subsubject_eav}}');
    }
}
