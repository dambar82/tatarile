<?php

namespace app\backend\models;

use app\models\Lang;
use webvimark\modules\UserManagement\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property integer $date_update
 * @property integer $date_create
 * @property integer $author
 * @property integer $parent_id
 * @property string $filename
 * @property integer $date_status
 */
class Subject extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author'], 'required'],
            [['author','parent_id','date_status'], 'integer'],
            [['filename'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_update' => 'Date Update',
            'date_create' => 'Date Create',
            'author' => 'Author',
            'parent_id' => 'Parent ID',
            'filename' => 'Subject image',
        ];
    }

    public function getSubjectEavAssoc()
    {
        $current_lang = Lang::getCurrent();

        if (($entity = Subject::findOne($this->id)) == NULL) {
            return '';
        }
        if (($properties = $this->hasMany(SubjectEav::className(), ['subject_id' => 'id'])->where(['lang_id' => $current_lang->id])) == NULL) {
            return '';
        }
        return $properties;
    }

    public function getUserName()
    {
        $parent = User::find()->where(['id'=>$this->author])->one();
        return Yii::t('app', $parent ? $parent->username : '');
    }
    public function getDefaultProperty()
    {
        $current_lang = Lang::getCurrent();
        $default_property = SubjectProperty::find()->where(['view' => 1])->one();
        $default_value = SubjectEav::find()
            ->select('subject_eav.value')
            ->innerJoin('subject','`subject`.`id` = `subject_eav`.`subject_id`')
            ->where(['subject_eav.property_id' => $default_property->id, 'subject_eav.lang_id' => $current_lang->id, 'subject_id' => $this->id])
            ->scalar();
        return $default_value;
    }
    static public function getAllSubjectsWithLang()
    {
        $current_lang = Lang::getCurrent();
        $default_property = SubjectProperty::find()->where(['view' => 1])->one();
        $default_value = SubjectEav::find()
            ->select('subject.id,subject_eav.value')
            ->innerJoin('subject','`subject`.`id` = `subject_eav`.`subject_id`')
            ->where(['subject_eav.property_id' => $default_property->id, 'subject_eav.lang_id' => $current_lang->id,'subject.parent_id' => 0])
            ->asArray()
            ->all();
        return ArrayHelper::map($default_value,'id','value');
    }
    public static function getLangSubjects()
    {
        $current_lang = Lang::getCurrent();
        $default_property = SubjectProperty::find()->where(['view' => 1])->one();
        $default_value = SubjectEav::find()
            ->innerJoin('subject','`subject`.`id` = `subject_eav`.`subject_id`')
            ->where(['subject_eav.property_id' => $default_property->id, 'subject_eav.lang_id' => $current_lang->id]);
        return $default_value;
    }
    static public function getAllSubSubjectsWithLang($id)
    {
        $current_lang = Lang::getCurrent();
        $default_property = SubjectProperty::find()->where(['view' => 1])->one();

        $default_value = SubjectEav::find()
            ->select('subject.id,subject_eav.value')
            ->innerJoin('subject','`subject`.`id` = `subject_eav`.`subject_id`')
            ->where(['subject_eav.property_id' => $default_property->id, 'subject_eav.lang_id' => $current_lang->id,'subject.parent_id' => $id])
            ->asArray()
            ->all();
        return ArrayHelper::map($default_value,'id','value');
    }
}
