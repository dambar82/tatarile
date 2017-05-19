<?php

use yii\db\Migration;

class m161216_153456_entity_statistics_old extends Migration
{
    public function safeUp()
    {
        $entities = \app\backend\models\Entity::find()->all();
        foreach ($entities as $entity) {
            $this->insert('entity_statistics',[
                'viewing_count' => 0,
                'unique_viewing_count' => 0,
                'entity_id' => $entity->id
            ]);
        }
    }

    public function safeDown()
    {
    }
}
