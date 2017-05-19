<?php

use yii\db\Migration;

class m161214_140230_move_subcategories_from_entity_table extends Migration
{

    public function safeUp()
    {
        $entities = \app\backend\models\Entity::find()->all();
        foreach ($entities as $entity) {
            $entity_sub_eav = new \app\backend\models\EntitySubsubjectEav();
            $entity_sub_eav->entity_id = $entity->id;
            $entity_sub_eav->subject_id = $entity->subcategory_id;
            $entity_sub_eav->save();
        }
    }

    public function safeDown()
    {
    }
}
