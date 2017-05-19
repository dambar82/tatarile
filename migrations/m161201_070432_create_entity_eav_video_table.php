<?php

use yii\db\Migration;

/**
 * Handles the creation of table `entity_eav_video`.
 */
class m161201_070432_create_entity_eav_video_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('entity_eav_video', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer(),
            'lang_id' => $this->integer(),
            'property_id' => $this->integer(),
            'value' => $this->text(),
            'entity_type' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('entity_eav_video');
    }
}
