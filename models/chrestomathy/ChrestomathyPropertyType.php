<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "property_type".
 *
 * @property integer $id
 * @property string $title
 */
class ChrestomathyPropertyType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property_type';
    }

    public static function getDb()
    {
        return Yii::$app->get('db_chrestomathy');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
        ];
    }
}
