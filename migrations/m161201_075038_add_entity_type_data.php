<?php

use yii\db\Migration;

class m161201_075038_add_entity_type_data extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('entity_type', ['entity_type','class'], [
            ['Article','app\backend\models\Entity'],
            ['Video','app\backend\models\Entity'],
            ['Audio','app\backend\models\Entity'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('entity_type', ['entity_type' => 'Article']);
        $this->delete('entity_type', ['entity_type' => 'Video']);
        $this->delete('entity_type', ['entity_type' => 'Audio']);
    }
}
