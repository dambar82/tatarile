<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "config_seo".
 *
 * @property integer $id
 * @property string $title
 * @property string $value
 */
class ConfigSeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config_seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['value'], 'string'],
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
            'title' => 'Title',
            'value' => 'Value',
        ];
    }
}
