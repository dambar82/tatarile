<?php

namespace app\modules\statistics\models;

use Yii;

/**
 * This is the model class for table "admin_action_statistics".
 *
 * @property integer $id
 * @property integer $date_update
 * @property integer $date_create
 * @property integer $status
 * @property string $name
 * @property integer $count
 * @property integer $views_count
 */
class AdminActionStatistics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    //public $name;
    //public $status;
    //public $count;
    //public $views_count;

    public static function tableName()
    {
        return 'admin_action_statistics';
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
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['date_update', 'date_create', 'status', 'count', 'views_count'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'name' => 'Name',
            'count' => 'Count',
            'views_count' => 'Views Count',
        ];
    }
}
