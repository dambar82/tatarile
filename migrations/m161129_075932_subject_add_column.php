<?php

use yii\db\Migration;

class m161129_075932_subject_add_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%subject}}','parent_id',$this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%subject}}','parent_id');
    }
}
