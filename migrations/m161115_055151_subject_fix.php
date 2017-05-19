<?php

use yii\db\Migration;

class m161115_055151_subject_fix extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%subject}}','author',$this->integer()->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%subject}}','author');
    }
}
