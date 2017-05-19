<?php

use yii\db\Migration;

class m161206_110512_create_config_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('config', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'value' => $this->string()->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('config');
    }
}
