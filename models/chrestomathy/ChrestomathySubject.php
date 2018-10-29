<?php

namespace app\models\chrestomathy;

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
class ChrestomathySubject extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->get('db_chrestomathy');
    }

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

    public function getEav()
    {
        return $this->hasOne(ChrestomathySubjectEav::class, ['subject_id' => 'id']);
    }

    public function getSubjectEavAssoc()
    {
        $current_lang = Lang::getCurrent();

        if (($entity = ChrestomathySubject::findOne($this->id)) == NULL) {
            return '';
        }
        if (($properties = $this->hasMany(ChrestomathySubjectEav::className(), ['subject_id' => 'id'])->where(['lang_id' => $current_lang->id])) == NULL) {
            return '';
        }
        return $properties;
    }

}
