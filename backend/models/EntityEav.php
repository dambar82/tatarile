<?php

namespace app\backend\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "article_eav".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property integer $lang_id
 * @property integer $property_id
 * @property string $value
 */
class EntityEav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        global $config;
        if(isset($config['params']) && isset($config['params']) && isset($config['params']['entity_type_for_eav']) && is_string($config['params']['entity_type_for_eav']) &&
        strlen($config['params']['entity_type_for_eav']) > 0
        )
            return 'entity_eav_'.$config['params']['entity_type_for_eav'];
        else
            throw new Exception('EntityEav entity_type error');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'lang_id', 'property_id'], 'required'],
            [['entity_id', 'lang_id', 'property_id'], 'integer'],
            //[['value'], 'string'],
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
            'lang_id' => 'Lang ID',
            'property_id' => 'Property ID',
            'value' => 'Value',
        ];
    }
}
