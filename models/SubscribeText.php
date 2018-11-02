<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscribe_text".
 *
 * @property integer $id
 * @property string $href
 * @property string $title
 * @property string $img
 */
class SubscribeText extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe_text';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['href', 'title', 'img'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Text'),
        ];
    }
}
