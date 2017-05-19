<?php

use yii\db\Migration;

class m161207_121231_newdata_property_data_v1 extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('entity_property', ['title','type_id','view','entity_type_id','name'], [
            ['Singer',1,1,3,'title'],
            ['Album',1,0,3,'annotation'],
            ['Title',1,1,2,'title'],
            ['Annotation',1,0,2,'annotation'],
            ['Title',1,1,4,'title'],
            ['Annotation',1,0,4,'annotation'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('entity_property', ['name' => 'title','entity_type_id' => 2]);
        $this->delete('entity_property', ['name' => 'annotation','entity_type_id' => 2]);
        $this->delete('entity_property', ['name' => 'title','entity_type_id' => 3]);
        $this->delete('entity_property', ['name' => 'annotation','entity_type_id' => 3]);
        $this->delete('entity_property', ['name' => 'title','entity_type_id' => 4]);
        $this->delete('entity_property', ['name' => 'annotation','entity_type_id' => 4]);
    }
}
