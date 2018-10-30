<?php

namespace app\backend\models;

use app\modules\admin\models\PdfContent;
use app\modules\file\helpers\ResizeImage;
use app\modules\user\models\UserFavorite;
use Yii;
use webvimark\modules\UserManagement\models\User;
use app\models\Lang;
use yii\base\Exception;
use zxbodya\yii2\galleryManager\GalleryBehavior;

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
 * @property integer $popular
 * @property string $thumbnail
 */
class Entity extends \yii\db\ActiveRecord
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
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'razvorot',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/files/gallery',
                'url' => Yii::getAlias('@web') . '/files/gallery',
                'versions' => [
                ]
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'user','title', 'slug'], 'required'],
            [['category_id', 'date_create', 'date_update', 'status', 'user','entity_type_id'], 'integer'],
            [['description','keywords','comments'], 'string'],
            [['corrector', 'slug','title','keywords','thumbnail'], 'string', 'max' => 255],
            ['slug', 'validateSlug'],//, 'on' => 'insert'
            [['event_date_begin','event_date_end'],'validateDate'],
            [['event_date_begin','event_date_end'],'safe'],
            [['cor','image_cor','ready', 'popular'],'integer', 'min' => 0, 'max' => 1]
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
            'popular' => Yii::t('app','Popular')
        ];
    }

    public function getEntityEav()
    {
        $current_lang = Lang::getCurrent();
        $this->setEav();

        return $this->hasMany(EntityEav::className(), ['entity_id' => 'id'])->where(['lang_id' => $current_lang->id]);
    }

    public function getEntityEavAssoc()
    {
        $current_lang = Lang::getCurrent();

        if (($entity = Entity::findOne($this->id)) == NULL) {//entity object
           return '';
        }

        $this->setEav();

        if (($properties = $this->hasMany(EntityEav::className(), ['entity_id' => 'id'])->where(['lang_id' => $current_lang->id])) == NULL) { //entity_properties
            return '';
        }
        return $properties;
    }

    public function getUserName()
    {
        $parent = User::find()->where(['id'=>$this->user])->one();
        return Yii::t('app', $parent ? $parent->username : '');
    }
    public function getDefaultProperty()
    {
        $current_lang = Lang::getCurrent();
        $default_property = EntityProperty::find()->where(['view' => 1])->one();
        $default_value = EntityEav::find()
            ->select('entity_eav.value')
            ->innerJoin('entity','`entity`.`id` = `entity_eav`.`entity_id`')
            ->where(['entity_eav.property_id' => $default_property->id, 'entity_eav.lang_id' => $current_lang->id, 'entity_id' => $this->id])
            ->scalar();
        return $default_value;
    }
    public function setEav()
    {
        if($this->entity_type_id > 0) {
            $entity_type = EntityType::findOne(['id' => $this->entity_type_id]);
            if($entity_type) {
                global $config;
                $config['params']['entity_type_for_eav'] = strtolower($entity_type->entity_type);
            }
        }
    }
    public function unsetEav()
    {
        global $config;
        $config['params']['entity_type_for_eav'] = NULL;
    }

    public function validateSlug()
    {
        $slug = $this->slug;
        $id = $this->id;
        if ($id == NULL) {
            if ($model = Entity::findOne(['slug' => $slug]) !== NULL)
            {
                $this->addError('slug', 'This slug already existsdd.');
            }
        }
        if (($model = Entity::find()->where(['slug' => $slug]))->andWhere(['<>','id',$id])->one() !== NULL)
        {
            $this->addError('slug', $id.'This slug already existsf.');
        }
    }
    public function validateDate() //не трогать
    {

    }

    public function afterDelete()
    {
        $entity_id = $this->id;
        $this->setEav();

        EntityEav::deleteAll(['entity_id' => $entity_id]);
        UserFavorite::deleteAll(['entity_id' => $entity_id]);
        VideoContent::deleteAll(['entity_id' => $entity_id]);
        PdfContent::deleteAll(['entity_id' => $entity_id]);
        EntitySubsubjectEav::deleteAll(['entity_id' => $entity_id]);
        EntityStatistics::deleteAll(['entity_id' => $entity_id]);
        EntityViewing::deleteAll(['entity_id' => $entity_id]);
        EntityTags::deleteAll(['entity_id' => $entity_id]);
        parent::afterDelete();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if (!empty($this->thumbnail)) {
            ResizeImage::resize($this->thumbnail);

        }
    }

    public function loadRelatedProductsArray()
    {
        $related = [];
        $relatedProductsArray = EntityRelated::findAll(['entity_id' => $this->id]);
        foreach ($relatedProductsArray as $key=>$item) {
            $related[] = Entity::find()->select('title')->where(['id' => $item->related_entity_id])->scalar();
        }
        return $related;
    }
    public function saveRelatedProducts($related)
    {
        EntityRelated::deleteAll(['entity_id' => $this->id]);

        if (!empty($related))

            foreach ($related as $index => $relatedEntityId) {
                if (!empty($relatedEntityId)) {
                    $rEI = $relatedEntityId;
                    if (Entity::find()->select('id')->where(['title' => $relatedEntityId])->scalar() != NULL) {
                        $rEI = Entity::find()->select('id')->where(['title' => $relatedEntityId])->scalar();
                    }

                    $relation = new EntityRelated();
                    $relation->attributes = [
                        'entity_id' => $this->id,
                        'related_entity_id' => $rEI,
                    ];
                    $relation->save();
                }
            }
    }
    public function setSubSubjects($ids) {
        if(!$this->isNewRecord) {
            EntitySubsubjectEav::deleteAll([
                'entity_id' => $this->id
            ]);
            if(is_array($ids) && count($ids) > 0) {
                foreach ($ids as $subcategoryID => $subcategoryVal) {
                    $subcategoryID = (int)$subcategoryID;
                    if($subcategoryID > 0 && $subcategoryVal) {
                        $subsubject_eav = new EntitySubsubjectEav();
                        $subsubject_eav->entity_id = $this->id;
                        $subsubject_eav->subject_id = $subcategoryID;
                        $subsubject_eav->save();
                    }
                }
            }
        }
    }
    public function save($runValidation = true, $attributeNames = null)
    {
        $is_new = false;
        if($this->isNewRecord)
            $is_new = true;
        $transaction = Yii::$app->db->beginTransaction();
        $saved = parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
        try {
            if($is_new && $this->id > 0) {
                $ent_stat = new EntityStatistics();
                $ent_stat->entity_id = $this->id;
                $ent_stat->viewing_count = 0;
                $ent_stat->unique_viewing_count = 0;
                $ent_stat->votes_sum = 0;
                $ent_stat->votes_count = 0;
                $ent_stat->points = 100;
                $ent_stat->save();
            }
            $transaction->commit();
        }
        catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        return $saved;
    }
    public function viewingAction(int $uid = NULL)
    {
        if(!$this->isNewRecord) {
            $ent_stat = EntityStatistics::findOne(['entity_id' => $this->id]);
            if($ent_stat) {
                if(Yii::$app->session->get('entity_viewing_'.$this->id) != 1) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {

                        $ent_stat->updateCounters(['viewing_count' => 1]);
                        $iplong = ip2long($_SERVER['REMOTE_ADDR']);
                        $viewingCond = [
                            'entity_id' => $this->id
                        ];
                        if(is_null($uid) || $uid < 0) $uid = 0;
                        if($uid > 0) {
                            $viewingCond['uid'] = $uid;
                        }
                        else {
                            $viewingCond['ip'] = $iplong;
                        }
                        $lastviewing = EntityViewing::findOne($viewingCond);
                        if(!$lastviewing) {
                            $lastviewing = new EntityViewing();
                            $lastviewing->entity_id = $this->id;
                            $lastviewing->ip = $iplong;
                            $lastviewing->viewing_time = gmdate("U");
                            $lastviewing->uid = $uid;
                            $lastviewing->save();
                            $ent_stat->updateCounters(['unique_viewing_count' => 1]);
                        }
                        $days = ceil((gmdate("U")-$this->date_create)/86400);
                        Yii::$app->db->createCommand("UPDATE `".EntityStatistics::tableName()."` SET `points` = ROUND(`viewing_count`/".$days.")+ROUND(10*`unique_viewing_count`/".$days.")+ROUND(20*(`votes_sum`+5)/(`votes_count`+1)) WHERE `id` = '".$ent_stat->id."'")->execute();
                        $transaction->commit();
                        Yii::$app->session->set('entity_viewing_'.$this->id,1);
                    }
                    catch (Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                    }
                }
            }
        }
    }
    public function findVote(int $uid)
    {
        if(!$this->isNewRecord && $uid > 0) {
            return EntityVote::findOne([
                'entity_id' => $this->id,
                'uid' => $uid
            ]);
        }
        else return NULL;
    }
    public function vote(int $uid,int $sum = 5)
    {
        if($uid > 0 && !$this->isNewRecord && !$this->findVote($uid) && $sum > 0 && $sum <=5) {
            $new_vote = new EntityVote();
            $new_vote->entity_id = $this->id;
            $new_vote->uid = $uid;
            $new_vote->vote_sum = $sum;
            $new_vote->vote_time = gmdate("U");
            $new_vote->ip = $iplong = ip2long($_SERVER['REMOTE_ADDR']);
            $ent_stat = EntityStatistics::findOne(['entity_id' => $this->id]);
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $new_vote->save();
                $ent_stat->updateCounters(['votes_count' => 1,'votes_sum' => $sum]);
                $days = ceil((gmdate("U")-$this->date_create)/86400);
                Yii::$app->db->createCommand("UPDATE `".EntityStatistics::tableName()."` SET `points` = ROUND(`viewing_count`/".$days.")+ROUND(10*`unique_viewing_count`/".$days.")+ROUND(20*(`votes_sum`+5)/(`votes_count`+1)) WHERE `id` = '".$ent_stat->id."'")->execute();
                $transaction->commit();
            }
            catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
    }

    public function getCategory()
    {
        return $this->hasOne(Subject::class, ['id' => 'category_id']);
    }

    public function getCategoryName()
    {
        return $this->category->propsByCurrentLang->value;
    }

    public function getEav()
    {
        $this->setEav();
        return $this->hasOne(EntityEav::class, ['entity_id' => 'id'])
            ->onCondition(['lang_id' => Lang::getCurrent()->id])
            ->andOnCondition(['property_id' => 1])
            ->andOnCondition(['<>', 'value', '']);
    }
}
