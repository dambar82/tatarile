<?php

namespace app\backend\modules\reader\models;

use Yii;

/**
 * This is the model class for table "chrestomathy_themes".
 *
 * @property integer $id
 * @property string $title
 * @property string $comment
 */
class ChrestomathyThemes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chrestomathy_themes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'comment' => 'Комментарии',
        ];
    }

    public function getArticles()
    {
        return $this->hasMany(ChrestomathyArticles::className(), ['theme_id' => 'id']);
    }
}
