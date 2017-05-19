<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "entity_vote".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property integer $ip
 * @property integer $uid
 * @property integer $vote_time
 * @property integer $vote_sum
 */
class EntityVote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_vote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'vote_time', 'vote_sum'], 'required'],
            [['entity_id', 'ip', 'uid', 'vote_time', 'vote_sum'], 'integer'],
            [['vote_sum'],'validateVoteSum']
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
            'ip' => 'Ip',
            'uid' => 'Uid',
            'vote_time' => 'Vote Time',
            'vote_sum' => 'Vote Sum',
        ];
    }
    public function validateVoteSum()
    {
        if($this->vote_sum <=0 || $this->vote_sum > 5) {
            $this->addError('vote_sum', 'Invalid vote sum parameter');
        }
    }
}
