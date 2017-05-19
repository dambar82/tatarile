<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "article_content_value".
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $value
 * @property integer $lang_id
 */
class ArticleContentValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_content_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'lang_id'], 'required'],
            [['content_id', 'lang_id'], 'integer'],
            [['value'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id' => 'Content ID',
            'value' => 'Value',
            'lang_id' => 'Lang ID',
        ];
    }
}
