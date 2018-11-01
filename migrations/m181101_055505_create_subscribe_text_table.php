<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subscribe_text`.
 */
class m181101_055505_create_subscribe_text_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subscribe_text', [
            'id' => $this->primaryKey(),
            'text' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subscribe_text');
    }
}
