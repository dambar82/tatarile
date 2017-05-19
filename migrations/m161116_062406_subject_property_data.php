<?php

use yii\db\Migration;

class m161116_062406_subject_property_data extends Migration
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
