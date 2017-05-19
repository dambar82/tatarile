<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "entity_type".
 *
 * @property integer $id
 * @property string $entity_type
 * @property string $class
 */
class EntityType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_type', 'class'], 'string', 'max' => 255],
            [['entity_type', 'class'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_type' => 'Entity Type',
            'class' => 'Class',
        ];
    }
}
