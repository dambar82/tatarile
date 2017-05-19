<?php

namespace app\backend\models;

use app\components\GetEntity;
use app\components\GetSubject;
use Yii;

/**
 * This is the model class for table "entity_related".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property integer $related_entity_id
 */
class EntityRelated extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_related';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id'], 'required'],
            [['entity_id', 'related_entity_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => Yii::t('app','Entity ID'),
            'related_entity_id' => Yii::t('app','Related Entity ID'),
        ];
    }

    public static function relatedEntity($items)
    {
        $result = NULL;
        foreach ($items as $item) {
            $related_entity = GetEntity::getEntityProperties($item->related_entity_id);
            if ($related_entity) {
                if (!empty($related_entity['title'])) {
                    $entity = Entity::findOne($item->related_entity_id);
                    $related_entity['subject'] = GetSubject::getSubjectTitle($entity->category_id);
                    $result[] = $related_entity;
                }
            }
        }

        return $result;
    }
}
