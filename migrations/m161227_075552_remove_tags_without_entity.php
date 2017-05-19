<?php

use yii\db\Migration;

class m161227_075552_remove_tags_without_entity extends Migration
{
    public function safeUp()
    {
        $entity_tags = \app\backend\models\EntityTags::find()->all();
        foreach ($entity_tags as $entity_tag) {
            if (!\app\backend\models\Entity::find()->where(['id' => $entity_tag->entity_id])->all()) {
                $entity_tag->delete();
            }
        }
    }

    public function safeDown()
    {
    }
}
