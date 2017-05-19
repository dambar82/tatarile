<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "article_content_image_eav".
 *
 * @property integer $id
 * @property integer $image_id
 * @property integer $lang_id
 * @property string $title
 * @property string $description
 */
class ArticleContentImageEav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_content_image_eav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'lang_id'], 'required'],
            [['image_id', 'lang_id'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Image ID',
            'lang_id' => 'Lang ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }
}
