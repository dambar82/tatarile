<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `entity_property`.
 */
class m161206_084856_create_entity_property_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%entity_property}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'type_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'view' => Schema::TYPE_INTEGER,
            'entity_type_id'=>Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT \'0\'',
            'name'=>Schema::TYPE_STRING . '(50) NOT NULL DEFAULT \'\'',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%entity_property}}');
    }
}
