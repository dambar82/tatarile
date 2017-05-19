<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "entity_eav_article".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property integer $lang_id
 * @property integer $property_id
 * @property string $value
 */
class EntityEavArticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_eav_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
