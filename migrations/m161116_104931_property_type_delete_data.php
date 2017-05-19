<?php

use yii\db\Migration;

class m161116_104931_property_type_delete_data extends Migration
{
    public function safeUp()
    {
        $this->delete('property_type', ['title' => 'integer']);
    }

    public function safeDown()
    {
        $this->batchInsert('property_type', ['title'], [
            ['integer'],
        ]);
    }
}
