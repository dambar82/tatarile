<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "audio_content".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property string $filename
 */
class AudioContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audio_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'filename'], 'required'],
            [['entity_id'], 'integer'],
            [['filename'], 'string', 'max' => 255],
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
            'filename' => 'Filename',
        ];
    }
}
