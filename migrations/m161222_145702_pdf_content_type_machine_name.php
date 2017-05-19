<?php

use yii\db\Migration;

class m161222_145702_pdf_content_type_machine_name extends Migration
{

    public function safeUp()
    {
        $entity_types = \app\backend\models\EntityType::find()->all();
        foreach ($entity_types as $entity_type) {
            $entity_type->entity_type = mb_strtolower($entity_type->entity_type);
            $entity_type->save();
        }
    }

    public function safeDown()
    {
    }
}
