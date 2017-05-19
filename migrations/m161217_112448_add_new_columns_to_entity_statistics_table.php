<?php

use yii\db\Migration;

/**
 * Handles adding new to table `entity_statistics`.
 */
class m161217_112448_add_new_columns_to_entity_statistics_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('entity_statistics','votes_count',\yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'');
        $this->addColumn('entity_statistics','votes_sum',\yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('entity_statistics','votes_count');
        $this->dropColumn('entity_statistics','votes_sum');
    }
}
