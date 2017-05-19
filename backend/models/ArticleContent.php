<?php

namespace app\backend\models;

use app\models\Lang;
use Yii;

/**
 * This is the model class for table "article_content".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $content_type
 * @property integer $sequence
 */
class ArticleContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'content_type', 'sequence'], 'required'],
            [['article_id', 'content_type', 'sequence'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'content_type' => 'Content Type',
            'sequence' => 'Sequence',
        ];
    }

    public function getImage()
    {
        return $this->hasMany(ArticleContentImage::className(), ['content_id' => 'id']);
    }
    public function getContent()
    {
        $current_lang = Lang::getCurrent();
        return $this->hasMany(ArticleContentValue::className(), ['content_id' => 'id'])->where(['lang_id' => $current_lang->id]);
    }
    public function afterDelete()
    {
        ArticleContentValue::deleteAll(['content_id' => $this->id]);
        ArticleContentImage::deleteAll(['content_id' => $this->id]);
        parent::afterDelete();
    }
}
