<?php

use yii\db\Migration;

class m161129_123717_property_type_data_add extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('article_property', ['title','type_id','view'], [
            ['Tags',3,0],
        ]);
    }

    public function safeDown()
    {
        $this->delete('article_property', ['title' => 'Tags']);
    }
}
