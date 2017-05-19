<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `subject_eav`.
 */
class m161206_072234_create_subject_eav_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subject_eav}}', [
            'id' => Schema::TYPE_PK,
            'subject_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'lang_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'property_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'value' => Schema::TYPE_TEXT,
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%subject_eav}}');
    }

}
