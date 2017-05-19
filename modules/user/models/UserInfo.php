<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property integer $age
 * @property string $school
 * @property string $school_class
 * @property string $address
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'last_name', 'first_name', 'birthday'], 'required'],
            [['user_id'], 'integer'],
            [['last_name', 'first_name', 'middle_name', 'school', 'school_class', 'address', 'birthday'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file_name' => Yii::t('app', 'File Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'last_name' => Yii::t('app', 'Last Name'),
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'birthday' => Yii::t('app', 'Birthday'),
            'age' => Yii::t('app', 'Age'),
            'school' => Yii::t('app', 'School'),
            'school_class' => Yii::t('app', 'School Class'),
            'address' => Yii::t('app', 'Address'),
        ];
    }
}
