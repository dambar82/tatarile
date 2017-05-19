<?php

use yii\db\Migration;

class m161201_131208_change_entity_property_column extends Migration
{

    public function safeUp()
    {
        $this->update('entity_property',['name' => 'title'],['view' => 1]);
        $this->update('entity_property',['name' => 'annotation'],['title' => 'Annotation']);
        $this->update('entity_property',['name' => 'information_source'],['title' => 'Information Source']);
        $this->update('entity_property',['name' => 'tags'],['title' => 'Tags']);
    }

    public function safeDown()
    {
    }
}
