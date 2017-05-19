<?php

use yii\db\Migration;

/**
 * Handles the creation of table `entity_statistics`.
 */
class m161216_083117_create_entity_statistics_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%entity_statistics}}', [
            'id' => $this->primaryKey(),
            'entity_id' => \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL',
            'views_count' =>  \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\''
        ], $tableOptions);
        $this->createTable('{{%entity_views}}', [
            'id' => $this->primaryKey(),
            'entity_id' => \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL',
            'ip' =>  \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'',
            'uid' => \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'',
            'viewing_time' => \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL'
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%entity_statistics}}');
        $this->dropTable('{{%entity_views}}');
    }
}
