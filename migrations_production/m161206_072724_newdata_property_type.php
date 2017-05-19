<?php

use yii\db\Migration;

class m161206_072724_newdata_property_type extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('property_type', ['title'], [
            ['string'],
            ['text'],
            ['tags'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('property_type', ['title' => 'string']);
        $this->delete('property_type', ['title' => 'text']);
        $this->delete('property_type', ['title' => 'tags']);
    }
}
