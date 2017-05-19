<?php

use yii\db\Migration;
use yii\db\Schema;

class m161207_080439_create_entity_eav_pdf extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%entity_eav_pdf}}', [
            'id' => Schema::TYPE_PK,
            'entity_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'lang_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'property_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'value' => Schema::TYPE_TEXT,
        ], $tableOptions);
        $this->renameTable('entity_eav','article_eav');
    }

    public function safeDown()
    {
        $this->dropTable('{{%entity_eav_pdf}}');
    }
}
