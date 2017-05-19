<?php

use yii\db\Migration;

class m161222_102704_add_pdf_tags extends Migration
{

    public function safeUp()
    {
        $this->insert('entity_property',[
            'title' => 'Tags',
            'type_id' => 3,
            'entity_type_id' => 4,
            'view' => 0,
            'name' => 'tags'
        ]);
    }

    public function safeDown()
    {
        $this->delete('entity_property',[
            'name' => 'tags',
            'type_id' => 3,
            'entity_type_id' => 4
        ]);
    }
}
