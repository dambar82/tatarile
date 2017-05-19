<?php

use yii\db\Migration;

class m161227_153426_tags_normalize extends Migration
{
    public function safeUp()
    {
        $entity_tags = \app\backend\models\EntityTags::find()->all();
        foreach ($entity_tags as $entity_tag) {
            $entity_tag->tag = \app\backend\models\EntityTags::normalize($entity_tag->tag);
            $entity_tag->save();
        }
    }

    public function safeDown()
    {
    }
}
