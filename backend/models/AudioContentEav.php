<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "audio_content_eav".
 *
 * @property integer $id
 * @property integer $audio_content_id
 * @property integer $lang_id
 * @property string $title
 * @property string $description
 */
class AudioContentEav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audio_content_eav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['audio_content_id', 'lang_id'], 'required'],
            [['audio_content_id', 'lang_id'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'audio_content_id' => 'Audio Content ID',
            'lang_id' => 'Lang ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }
}
