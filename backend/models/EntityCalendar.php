<?php

namespace app\backend\models;

use app\components\GetEntity;
use Yii;

/**
 * This is the model class for table "entity_calendar".
 *
 * @property integer $id
 * @property integer $date
 * @property integer $entity_id
 * @property integer $entity_type
 */
class EntityCalendar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_calendar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id','entity_type'], 'integer'],
            [['date'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'entity_id' => 'Entity ID',
            'entity_type' => 'Entity Type',
        ];
    }
    public static function getTodayEntity($type)
    {
        $current_date = strtotime(date('d-m-Y'));
        if ($type != 1) {
            $type = 0;
        }
        if (($entity = EntityCalendar::findOne(['date' => $current_date, 'entity_type' => $type])) == NULL) {
            return NULL;
        }

        $entity_id = $entity->entity_id;

        $entity = GetEntity::getEntityProperties($entity_id);
        if (!$entity['title']) {
            return NULL;
        }

        return $entity;
    }
}
