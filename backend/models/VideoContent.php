<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "video_content".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property string $filename
 */
class VideoContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'filename'], 'required', 'on' => 'insert'],
            [['entity_id'], 'integer'],
            [['filename'], 'string', 'max' => 255],
            [['filename'], 'safe'],
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
