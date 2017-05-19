<?php

use yii\db\Migration;

class m161221_081147_add_new_entity_property extends Migration
{

    public function safeUp()
    {
        $entity_types = \app\backend\models\EntityType::find()->all();
        foreach ($entity_types as $entity_type) {
            $this->insert('entity_property',[
                'title' => 'Thumbnail title',
                'type_id' => 1,
                'view' => 0,
                'entity_type_id' => $entity_type->id,
                'name' => 'thumbnail_title'
            ]);
        }
    }

    public function safeDown()
    {
    }
}
