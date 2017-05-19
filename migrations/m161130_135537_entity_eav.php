<?php

use yii\db\Migration;
use yii\db\Schema;

class m161130_135537_entity_eav extends Migration
{
    public function safeUp()
    {
        $this->dropTable('{{%entity_eav}}');
        $this->renameTable('article_eav','entity_eav');
        $this->renameColumn('entity_eav','article_id','entity_id');
    }

    public function safeDown()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%entity_eav}}', [
            'id' => Schema::TYPE_PK,
            'entity_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'lang_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'property_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'value' => Schema::TYPE_TEXT,
        ], $tableOptions);
        $this->renameTable('entity_eav','article_eav');
    }
}
