<?php

use yii\db\Migration;

class m161116_061913_subject_property_newcolumn extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%subject_property}}','view',$this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%subject_property}}','view');
    }
}
