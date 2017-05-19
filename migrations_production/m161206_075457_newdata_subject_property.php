<?php

use yii\db\Migration;

class m161206_075457_newdata_subject_property extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('subject_property', ['title','type_id','view'], [
            ['Subject title','1','1'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('subject_property', ['id' => '1']);
    }
}
