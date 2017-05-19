<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "entity_viewing".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property integer $ip
 * @property integer $uid
 * @property integer $viewing_time
 */
class EntityViewing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_viewing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'viewing_time'], 'required'],
            [['entity_id', 'ip', 'uid', 'viewing_time'], 'integer']
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
            'viewing_time' => 'Viewing Time',
        ];
    }
}
