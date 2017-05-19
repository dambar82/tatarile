<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "subject_property".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type_id
 * @property integer $view
 */
class SubjectProperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type_id'], 'required'],
            [['type_id','view'], 'integer'],
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
            'type_id' => 'Type ID',
            'view' => 'Default Property',
        ];
    }

    public function getTypeName()
    {
        $parent = PropertyType::find()->where(['id'=>$this->type_id])->one();
        return Yii::t('app', $parent ? $parent->title : '');
    }
}
