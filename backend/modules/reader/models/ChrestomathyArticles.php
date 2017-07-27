<?php

namespace app\backend\modules\reader\models;

use Yii;

/**
 * This is the model class for table "chrestomathy_articles".
 *
 * @property integer $id
 * @property integer $theme_id
 * @property string $image
 * @property string $title
 * @property string $author
 * @property string $content
 */
class ChrestomathyArticles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chrestomathy_articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theme_id'], 'integer'],
            [['title'], 'required'],
            [['content'], 'string'],
            [['image', 'title', 'author'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'theme_id' => 'Тема',
            'image' => 'Изображение',
            'title' => 'Заголовок',
            'author' => 'Автор',
            'content' => 'Контент',
        ];
    }
}
