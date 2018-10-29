<?php

namespace app\models\chrestomathy;

use Yii;

/**
 * This is the model class for table "subject_eav".
 *
 * @property integer $id
 * @property integer $subject_id
 * @property integer $lang_id
 * @property integer $property_id
 * @property string $value
 */
class ChrestomathySubjectEav extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->get('db_chrestomathy');
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject_eav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'lang_id', 'property_id'], 'required'],
            [['subject_id', 'lang_id', 'property_id'], 'integer'],
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
            'subject_id' => 'Subject ID',
            'lang_id' => 'Lang ID',
            'property_id' => 'Property ID',
            'value' => 'Value',
        ];
    }
    public function getSubject()
    {
        return $this->hasMany(ChrestomathySubject::className(), ['id' => 'subject_id']);
    }
}
