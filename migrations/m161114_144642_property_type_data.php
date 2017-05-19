<?php

use yii\db\Migration;

class m161114_144642_property_type_data extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('property_type', ['title'], [
            ['string'],
            ['text'],
            ['integer'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('property_type', ['title' => 'string']);
        $this->delete('property_type', ['title' => 'text']);
        $this->delete('property_type', ['title' => 'integer']);
    }
}
