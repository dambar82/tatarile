<?php

namespace app\backend\models;

use app\models\Lang;
use Yii;

/**
 * This is the model class for table "article_content_image".
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $filename
 */
class ArticleContentImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_content_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id'], 'required'],
            [['content_id'], 'integer'],
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
            'content_id' => 'Content ID',
            'filename' => 'Filename',
        ];
    }
    public function getAbstract()
    {
        $current_lang = Lang::getCurrent();
        return $this->hasMany(ArticleContentImageEav::className(), ['image_id' => 'id'])->where(['lang_id' => $current_lang->id]);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        ArticleContentImageEav::deleteAll(['image_id' => $this->id]);
    }
}
