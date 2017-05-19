<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "entity_statistics".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property integer $viewing_count
 * @property integer $unique_viewing_count
 * @property integer $votes_count
 * @property integer $votes_sum
 * @property integer $points
 */
class EntityStatistics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_statistics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id'], 'required'],
            [['entity_id'], 'integer', 'min' => 1],
            [['viewing_count','unique_viewing_count','votes_count','votes_sum','points'],'integer', 'min' => 0]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'viewing_count' => 'Viewing Count',
            'unique_viewing_count' => 'Unique Viewing Count',
            'votes_count' => 'Votes Count',
            'votes_sum' => 'Votes Sum',
            'points' => 'Rating points'
        ];
    }
}
