<?php

use yii\db\Migration;

/**
 * Handles adding new to table `entity`.
 */
class m161221_071954_add_new_columns_to_entity_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('entity','cor',\yii\db\mysql\Schema::TYPE_INTEGER . '(1) NOT NULL DEFAULT \'0\'');
        $this->addColumn('entity','image_cor',\yii\db\mysql\Schema::TYPE_INTEGER . '(1) NOT NULL DEFAULT \'0\'');
        $this->addColumn('entity','ready',\yii\db\mysql\Schema::TYPE_INTEGER . '(1) NOT NULL DEFAULT \'0\'');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('entity','cor');
        $this->dropColumn('entity','image_cor');
        $this->dropColumn('entity','ready');
    }
}
