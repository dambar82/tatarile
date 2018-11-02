<?php

use yii\db\Migration;

class m181102_102957_add_column_to_text extends Migration
{
    public function safeUp()
    {
        $this->addColumn('subscribe_text', 'category', $this->string());
    }

    public function safeDown()
    {
        echo "m181102_102957_add_column_to_text cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181102_102957_add_column_to_text cannot be reverted.\n";

        return false;
    }
    */
}
