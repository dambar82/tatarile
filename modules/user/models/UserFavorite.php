<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_favorite".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $entity_id
 */
class UserFavorite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_favorite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'entity_id'], 'required'],
            [['user_id', 'entity_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'entity_id' => Yii::t('app', 'Entity ID'),
        ];
    }
}
