<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "entity_date_format".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property string $type
 * @property string $format
 */
class EntityDateFormat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_date_format';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id'], 'integer'],
            [['type', 'format'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'format' => 'Format',
        ];
    }
    public static function saveFormat($model_id,$date,$type)
    {
        if (!empty($date)) {
            if (($dateFormat = EntityDateFormat::findOne(['entity_id' => $model_id, 'type' => $type])) == NULL) {
                $dateFormat = new EntityDateFormat();
                $dateFormat->type = $type;
                $dateFormat->entity_id = $model_id;
            }

            $formating = explode('.',$date);
            if ((count($formating)) == 1) {
                $dateFormat->format = 'y';
            }
            if ((count($formating)) == 2) {
                $dateFormat->format = 'm';
            }
            if ((count($formating)) == 3) {
                $dateFormat->format = 'd';
            }
            $dateFormat->save();
        }
    }
    public static function viewFormat($model_id,$date,$type)
    {
        if (!empty($date)) {
            $dateFormat = EntityDateFormat::findOne(['entity_id' => $model_id, 'type' => $type]);
            $format = $dateFormat->format;
            if ($format == 'y') {$result = 'Y';}
            if ($format == 'm') {$result = 'm.Y';}
            if ($format == 'd') {$result = 'd.m.Y';}
            return $result;
        }
        return NULL;
    }
}
