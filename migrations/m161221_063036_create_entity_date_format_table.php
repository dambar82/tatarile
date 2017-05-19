<?php

use yii\db\Migration;

/**
 * Handles the creation of table `entity_date_format`.
 */
class m161221_063036_create_entity_date_format_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('entity_date_format', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer(),
            'type' => $this->string(),
            'format' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('entity_date_format');
    }
}
