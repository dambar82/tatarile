<?php

use yii\db\Migration;

class m161221_161630_old_ratings_entity extends Migration
{

    public function safeUp()
    {
        $entities = \app\backend\models\Entity::find()->all();
        foreach ($entities as $entity) {
            $days = ceil((gmdate("U")-$entity->date_create)/86400);
            Yii::$app->db->createCommand("UPDATE `".\app\backend\models\EntityStatistics::tableName()."` SET `points` = ROUND(`viewing_count`/".$days.")+ROUND(10*`unique_viewing_count`/".$days.")+ROUND(20*(`votes_sum`+5)/(`votes_count`+1)) WHERE `entity_id` = '".$entity->id."'")->execute();
        }
    }

    public function safeDown()
    {
    }
}
