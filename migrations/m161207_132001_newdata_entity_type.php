<?php

use yii\db\Migration;

class m161207_132001_newdata_entity_type extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('entity_type', ['entity_type','class'],[
            ['PDF','app\backend\models\Entity']
        ]);
    }

    public function safeDown()
    {
        $this->delete('entity_type', ['entity_type' => 'PDF']);
    }
}
