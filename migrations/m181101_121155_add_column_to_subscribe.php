<?php

use yii\db\Migration;

class m181101_121155_add_column_to_subscribe extends Migration
{
    public function safeUp()
    {
        $this->addColumn('subscribe_text', 'href', $this->string());
        $this->addColumn('subscribe_text', 'title', $this->string());
        $this->addColumn('subscribe_text', 'img', $this->string());
        $this->dropColumn('subscribe_text', 'text');
    }

    public function safeDown()
    {
        echo "m181101_121155_add_column_to_subscribe cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181101_121155_add_column_to_subscribe cannot be reverted.\n";

        return false;
    }
    */
}
