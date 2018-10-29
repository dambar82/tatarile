<?php

namespace app\models\chrestomathy;

use app\modules\admin\models\PdfContent;
use app\modules\file\helpers\ResizeImage;
use app\modules\user\models\UserFavorite;
use Yii;
use webvimark\modules\UserManagement\models\User;
use app\models\Lang;
use yii\base\Exception;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $date_create
 * @property integer $date_update
 * @property integer $status
 * @property integer $user
 * @property string $corrector
 * @property string $description
 * @property string $keywords
 * @property string $event_date_begin
 * @property string $event_date_end
 * @property string $slug
 * @property integer $entity_type_id
 * @property integer $class
 * @property string $thumbnail
 * @property string $audio
 */
class ChrestomathyEntity extends \yii\db\ActiveRecord
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
        return 'entity';
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
            [['category_id', 'user','title', 'slug'], 'required'],
            [['category_id', 'date_create', 'date_update', 'status', 'user','entity_type_id','class'], 'integer'],
            [['description','keywords','comments', 'audio'], 'string'],
            [['corrector', 'slug','title','keywords','thumbnail'], 'string', 'max' => 255],
            ['slug', 'validateSlug'],//, 'on' => 'insert'
            [['event_date_begin','event_date_end'],'validateDate'],
            [['event_date_begin','event_date_end'],'safe'],
            [['cor','image_cor','ready'],'integer', 'min' => 0, 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'date_create' => Yii::t('app','Date Create'),
            'date_update' => Yii::t('app','Date Update'),
            'status' => Yii::t('app','Status'),
            'user' => Yii::t('app','User'),
            'slug' => Yii::t('app','Slug'),
            'keywords' => Yii::t('app','Keywords'),
            'corrector' => Yii::t('app','Corrector'),
            'description' => Yii::t('app','Meta Description'),
            'title' => Yii::t('app','Meta Title'),
            'category_id' => Yii::t('app','Category Group'),
            'thumbnail' => Yii::t('app','Thumbnail'),
            'event_date_begin' => Yii::t('app','Event Date Begin'),
            'event_date_end' => Yii::t('app','Event Date End'),
            'cor' => Yii::t('app','Entity is corrected'),
            'image_cor' => Yii::t('app','Images are correct'),
            'ready' => Yii::t('app','Content is ready'),
            'comments' => Yii::t('app','Admin comments'),
            'audio' => Yii::t('app','Audio')
        ];
    }

    public function setEav()
    {
        if($this->entity_type_id > 0) {
            $entity_type = ChrestomathyEntityType::findOne(['id' => $this->entity_type_id]);
            if($entity_type) {
                global $config;
                $config['params']['entity_type_for_eav'] = strtolower($entity_type->entity_type);
            }
        }
    }

    public function getCategory()
    {
        return $this->hasOne(ChrestomathySubject::class, ['id' => 'category_id']);
    }

    public function getEav()
    {
        $this->setEav();
        return $this->hasOne(ChrestomathyEntityEav::class, ['entity_id' => 'id'])
            ->onCondition(['lang_id' => Lang::getCurrent()->id])
            ->andOnCondition(['property_id' => 1])
            ->andOnCondition(['<>', 'value', '']);
    }
}
