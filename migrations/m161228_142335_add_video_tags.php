<?php

use yii\db\Migration;

class m161228_142335_add_video_tags extends Migration
{
    public function safeUp()
    {
        $this->insert('entity_property',[
            'title' => 'Tags',
            'type_id' => 3,
            'entity_type_id' => 2,
            'view' => 0,
            'name' => 'tags'
        ]);
    }

    public function safeDown()
    {
        $this->delete('entity_property',[
            'name' => 'tags',
            'type_id' => 3,
            'entity_type_id' => 2
        ]);
    }
}
