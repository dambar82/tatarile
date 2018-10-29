<?php

use yii\db\Migration;

class m181029_102513_add_popular extends Migration
{
    public function safeUp()
    {
        $this->addColumn('entity', 'popular', $this->smallInteger()->defaultValue(0));
    }

    public function safeDown()
    {
        echo "m181029_102513_add_popular cannot be reverted.\n";

        return false;
    }
}
