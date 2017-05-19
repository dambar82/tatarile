<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Handles the creation of table `entity_eav`.
 */
class m161206_083844_create_entity_eav_table extends Migration
{
    public function safeUp()
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
    }

    public function safeDown()
    {
        $this->dropTable('{{%entity_eav}}');
    }
}
