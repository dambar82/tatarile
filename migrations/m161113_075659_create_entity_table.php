<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `entity`.
 */
class m161113_075659_create_entity_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%entity}}', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'subcategory_id' => Schema::TYPE_INTEGER,
            'date_create' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date_update' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER,
            'user' => Schema::TYPE_INTEGER . ' NOT NULL',
            'corrector' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'slug' => Schema::TYPE_STRING. ' NOT NULL DEFAULT \'\'',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'keywords' => Schema::TYPE_STRING,
            'event_date_begin' => Schema::TYPE_BIGINT,
            'event_date_end' => Schema::TYPE_BIGINT,
            'thumbnail'=>Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
            'entity_type_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'1\'',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%entity}}');
    }
}
