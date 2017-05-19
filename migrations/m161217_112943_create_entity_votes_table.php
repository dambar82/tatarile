<?php

use yii\db\Migration;

/**
 * Handles the creation of table `entity_votes`.
 */
class m161217_112943_create_entity_votes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('entity_vote', [
            'id' => $this->primaryKey(),
            'entity_id' => \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL',
            'ip' =>  \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'',
            'uid' => \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'',
            'vote_time' => \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL',
            'vote_sum' => \yii\db\mysql\Schema::TYPE_INTEGER . '(1) NOT NULL'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('entity_vote');
    }
}
