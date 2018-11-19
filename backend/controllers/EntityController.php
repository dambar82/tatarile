<?php

namespace app\backend\controllers;

use app\backend\models\ArticleContent;
use app\backend\models\ArticleContentImage;
use app\backend\models\ArticleContentImageEav;
use app\backend\models\ArticleContentValue;
use app\backend\models\AudioContent;
use app\backend\models\AudioContentEav;
use app\backend\models\EntityDateFormat;
use app\backend\models\EntityRelated;

use app\backend\models\EntityTags;
use app\backend\models\EntityType;

use app\backend\models\VideoContent;
use app\components\GetEntity;
use app\components\Helper;
use app\modules\admin\models\PdfContent;
use Yii;
use app\backend\models\Entity;
use app\backend\models\EntitySearch;

use yii\base\DynamicModel;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\backend\models\EntityEav;
use app\backend\models\EntityProperty;
use app\models\Lang;
use yii\web\UploadedFile;
use yii\imagine\Image;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * EntityController implements the CRUD actions for Entity model.
 */
class EntityController extends Controller
{
    private $uploadDir = "files/articles/";
    private $uploadAudioDir = "files/audio/";
    private $uploadVideoDir = "files/video/";
    private $uploadPdfDir = "files/pdf/";
    private $uploadThumbStyleDir = "files/280x230/";

    public function actions()
    {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                'types' => [
                    'razvorot' => Entity::className()
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Entity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntitySearch();
        $entity_type_id = Yii::$app->getRequest()->get('id');

        if (empty($entity_type_id)) {
            throw new NotFoundHttpException('Not fount entity_id.');
        }
        if (($entity_type = EntityType::findOne($entity_type_id)) == NULL)
        {
            throw new NotFoundHttpException('Entity not exist.');
        }
        $searchModel->entity_type_id = $entity_type_id;
        $searchModel->setEav();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'entity_type_id' => $entity_type_id,
        ]);
    }

    public function actionAll()
    {
        $searchModel = new EntitySearch();
        $entity_type_id = Yii::$app->getRequest()->get('id');

        if (empty($entity_type_id)) {
            throw new NotFoundHttpException('Not fount entity_id.');
        }
        if (($entity_type = EntityType::findOne($entity_type_id)) == NULL)
        {
            throw new NotFoundHttpException('Entity not exist.');
        }
        $searchModel->entity_type_id = $entity_type_id;
        $searchModel->setEav();
        $dataProvider = $searchModel->searchall(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'entity_type_id' => $entity_type_id,
        ]);
    }

    public function actionSuccess()
    {
        $searchModel = new EntitySearch();
        $entity_type_id = Yii::$app->getRequest()->get('id');

        if (empty($entity_type_id)) {
            throw new NotFoundHttpException('Not fount entity_id.');
        }
        if (($entity_type = EntityType::findOne($entity_type_id)) == NULL)
        {
            throw new NotFoundHttpException('Entity not exist.');
        }
        $searchModel->entity_type_id = $entity_type_id;
        $searchModel->setEav();
        $dataProvider = $searchModel->search_success(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'entity_type_id' => $entity_type_id,
        ]);
    }


    /**
     * Displays a single Entity model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $properties = '';
        if (isset($id)) {
            $entity = $this->findModel($id);
            $entity->setEav();
            $propertiesByLang = EntityEav::find()->where(['entity_id' => $id])->all();
            if (isset($propertiesByLang))
            {
                foreach ($propertiesByLang as $p){
                    $properties[$p->lang_id][] = $p;
                }
            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'properties' => $properties
        ]);
    }

    /**
     * Creates a new Entity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    protected function newEntity($entity_type_id)
    {
        $model = new Entity();
        $model->status = 1;
        $model->entity_type_id = $entity_type_id;
        return $model;
    }

    protected function newEntityEav($property_id,$lang_id,$model_id)
    {
        $model_eav = new EntityEav();
        $model_eav->property_id = $property_id;
        $model_eav->lang_id = $lang_id;
        $model_eav->entity_id = $model_id;
        return $model_eav;
    }

    protected function strToDate($strdat,$era)
    {
        $result = NULL;
        if ($strdat != NULL) {
            if ($era == 1) {
                $result = intval(Helper::strtotime($strdat,true));
            }
            else {
                $result = intval(Helper::strtotime($strdat,false));
            }
            return $result;
        }

        return NULL;
    }

    public function actionCreate()
    {
        $entity_type_id = Yii::$app->getRequest()->get('id');

        $properties = EntityProperty::find()->where(['entity_type_id' => $entity_type_id])->all();
        $properties_map = ArrayHelper::map($properties,'id','title');
        $languages = Lang::find()->all();

        if (empty($entity_type_id)) {
            throw new NotFoundHttpException('Not fount entity_id.');
        }

        if (($entity_type = EntityType::findOne($entity_type_id)) == NULL) {
            throw new NotFoundHttpException('Entity not exist.');
        }

        $model = $this->newEntity($entity_type_id);

        $model_related = new EntityRelated();

        $model->setEav();

        foreach ($languages as $lang) {
            foreach ($properties as $property) {
                $model_eav[$property->id][$lang->id] = $this->newEntityEav($property->id,$lang->id,$model->id);
            }
        }
        //дефолтные модели, если нужны, то сгенерятся
        $model_video = new VideoContent();
        $model_pdf = new PdfContent();

        $date_model = new DynamicModel(['d_1', 'd_2']);
        $date_model->addRule(['d_1','d_2'], 'string',['max'=>2]);
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()) {

            $thumb_file = UploadedFile::getInstance($model,"thumbnail");
            if($thumb_file) {

                if (!file_exists(Yii::getAlias('@web').$this->uploadThumbStyleDir)) {
                    mkdir(Yii::getAlias('@web').$this->uploadThumbStyleDir);
                }
                $thumbnail = md5($thumb_file->baseName. date("YmdHms")) .'.'. $thumb_file->extension;

                $model->thumbnail = $thumbnail;

                $thumb_file->saveAs(Yii::getAlias('@webroot/files/thumb/').$thumbnail);
                Image::thumbnail(Yii::getAlias('@webroot/files/thumb/').$thumbnail , 280, 230)
                    ->save(Yii::getAlias('@webroot').'/'.$this->uploadThumbStyleDir.$thumbnail, ['quality' => 50]);
            }

            $date_model->load($request->post());

            $start_date = $model->event_date_begin;
            $end_date = $model->event_date_end;

            $model->event_date_begin = $this->strToDate($start_date,$date_model->d_1);
            $model->event_date_end = $this->strToDate($end_date,$date_model->d_2);

            $model->save();

            EntityDateFormat::saveFormat($model->id,$start_date,'begin');
            EntityDateFormat::saveFormat($model->id,$end_date,'end');

            $subcategories = $request->post('subcategory');
            $model->setSubSubjects($subcategories);

            $model->saveRelatedProducts($_POST['EntityRelated']['related_entity_id']);

            if (!empty($_POST['EntityEav']))
            {
                foreach ($_POST['EntityEav'] as $lang_key=>$lang) {
                    foreach ($properties_map as $prop_key=>$property) {
                        $ent_prop = EntityProperty::findOne(['id' => $model_eav[$prop_key][$lang_key]->property_id]);
                        if ($ent_prop->type_id == 3)
                        {//тэги
                            if ($lang[$prop_key]['value'])
                            {
                                foreach ($lang[$prop_key]['value'] as $value) {
                                    $tag = new EntityTags();
                                    $tag->tag = $value;
                                    $tag->entity_id = $model->id;
                                    $tag->lang_id = $lang_key;
                                    $tag->save();
                                }
                            }
                        }
                        else
                        { //text и string
                            $model_eav[$prop_key][$lang_key]->value = $lang[$prop_key]['value'];
                            if($ent_prop->name == 'title')
                                $model_eav[$prop_key][$lang_key]->value = trim($model_eav[$prop_key][$lang_key]->value);
                            $model_eav[$prop_key][$lang_key]->entity_id = $model->id;

                            $model_eav[$prop_key][$lang_key]->save();
                        }
                    }
                }
            }

            if ($entity_type_id == 1) {
                if (!empty($_POST['ArticleContentValue'])) {
                    foreach ($_POST['ArticleContentValue'] as $key=>$value) { //обновление контента
                        $article_content_new_id = 0;
                        foreach ($value as $lang_key => $property) {
                            if (empty($model_content[$key][$lang_key]))
                            {
                                if (ArticleContentValue::findOne(['content_id'=>$article_content_new_id]) == null) {
                                    $article_content_new = new ArticleContent();
                                    $article_content_new->article_id = $model->id;
                                    $article_content_new->content_type = 1;
                                    $article_content_new->sequence = $key;
                                    $article_content_new->save();
                                    $article_content_new_id = $article_content_new->id;
                                }

                                $model_content[$key][$lang_key] = new ArticleContentValue();
                                $model_content[$key][$lang_key]->content_id = $article_content_new_id;
                                $model_content[$key][$lang_key]->value = Html::encode($property['value']);
                                $model_content[$key][$lang_key]->lang_id = $lang_key;
                                $model_content[$key][$lang_key]->save();
                            }
                            else
                            {
                                $model_content[$key][$lang_key]->value = Html::encode($property['value']);
                                $model_content[$key][$lang_key]->save();
                            }
                        }
                    }
                }

                if (!empty($_FILES['ArticleContentImage'])) {
                    foreach ($_FILES['ArticleContentImage']['name'] as $key => $img) {
                        $img_iindex = $key;

                        $article_content_new = new ArticleContent();
                        $article_content_new->article_id = $model->id;
                        $article_content_new->content_type = 2;
                        $article_content_new->sequence = $img_iindex;
                        $article_content_new->save();

                        $model_content_image = new ArticleContentImage();
                        $img_file = UploadedFile::getInstance($model_content_image,"[{$img_iindex}]filename");
                        if (!empty($img_file)) {
                            $filename = md5($img_file->baseName. date("YmdHms")) .'.'. $img_file->extension;
                            $img_file-> saveAs($this->uploadDir.$filename);
                            $model_content_image->filename = $filename;
                        } else {$model_content_image->filename ='non-image.jpg';}
                        $model_content_image->content_id = $article_content_new->id;
                        $model_content_image->save();

                        foreach ($languages as $lang) {
                            $model_content_image_eav = new ArticleContentImageEav();
                            $model_content_image_eav->image_id = $model_content_image->id;
                            $model_content_image_eav->lang_id = $lang->id;
                            $model_content_image_eav->title = $_POST['ArticleContentImageEav'][$img_iindex][$lang->id]['title'];
                            $model_content_image_eav->description = $_POST['ArticleContentImageEav'][$img_iindex][$lang->id]['description'];
                            $model_content_image_eav->save();
                        }
                    }
                }
            }

            if ($entity_type_id == 2) {
                if (!empty($_FILES['VideoContent'])) {
                    if (!empty($_FILES['VideoContent']['name']['filename'])) {
                        $video_file = UploadedFile::getInstance($model_video,"filename");
                        $filename = md5($video_file->baseName. date("YmdHms")) .'.'. $video_file->extension;
                        $video_file->saveAs($this->uploadVideoDir.$filename);
                        $model_video->entity_id = $model->id;
                        $model_video->filename = $filename;
                        $model_video->save();
                    }
                }
            }

            if ($entity_type_id == 3) {
                if (!empty($_FILES['AudioContent'])) {
                    if (!empty($_FILES['AudioContent']['name']['filename'])) {
                        foreach ($_FILES['AudioContent']['name'] as $audio_index => $audiofile) {

                            $model_audio = new AudioContent();
                            $audio_file = UploadedFile::getInstance($model_audio,"[{$audio_index}]filename");

                            if (!empty($audio_file)) {
                                $filename = md5($audio_file->baseName. date("YmdHms")) .'.'. $audio_file->extension;
                                $audio_file->saveAs($this->uploadAudioDir.$filename);
                                $model_audio->filename = $filename;
                                $model_audio->save();
                            }

                            foreach ($languages as $lang) {
                                $model_audio_eav = new AudioContentEav();
                                $model_audio_eav->audio_content_id = $model_audio->id;
                                $model_audio_eav->lang_id = $lang->id;
                                $model_audio_eav->title = $_POST['AudioContentEav'][$audio_index][$lang->id]['title'];
                                $model_audio_eav->description = $_POST['AudioContentEav'][$audio_index][$lang->id]['description'];
                                $model_audio_eav->save();
                            }
                        }
                    }
                }
            }

            if ($entity_type_id == 4) {
                $this->enableCsrfValidation = false;
                if (!empty($_FILES['PdfContent'])) {
                    if (!empty($_FILES['PdfContent']['name']['filename'])) {
                        $pdf_file = UploadedFile::getInstance($model_pdf,"filename");
                        $filename = md5($pdf_file->baseName. date("YmdHms")) .'.'. $pdf_file->extension;
                        $pdf_file->saveAs($this->uploadPdfDir.$filename);
                        $model_pdf->entity_id = $model->id;
                        $model_pdf->filename = $filename;
                        $model_pdf->save();
                    }
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if ($entity_type_id == 2) {
                return $this->render('create', [
                    'model' => $model,
                    'model_eav' => $model_eav,
                    'model_video' => $model_video,
                    'model_pdf' => $model_pdf,
                    'date_model' => $date_model,
                    'model_related' => $model_related,

                ]);
            }
            if ($entity_type_id == 4) {
                return $this->render('create', [
                    'model' => $model,
                    'model_eav' => $model_eav,
                    'model_video' => $model_video,
                    'model_pdf' => $model_pdf,
                    'date_model' => $date_model,
                    'model_related' => $model_related,

                ]);
            }

            return $this->render('create', [
                'model' => $model,
                'model_eav' => $model_eav,
                'date_model' => $date_model,
                'model_video' => $model_video,
                'model_pdf' => $model_pdf,
                'model_related' => $model_related,
            ]);
        }
    }

    /**
     * Updates an existing Entity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model_related = new EntityRelated();

        $date_model = new DynamicModel(['d_1', 'd_2']);
        $date_model->addRule(['d_1','d_2'], 'string',['max'=>2]);


        if ($model->event_date_begin) {
            $begin_format = EntityDateFormat::viewFormat($model->id,$model->event_date_begin,'begin');
            $event_date_begin = Helper::gmdate($begin_format,$model->event_date_begin,false);
            $model->event_date_begin = $event_date_begin['date'];
            $date_model->d_1 = $event_date_begin['age'];
        }
        else { $model->event_date_begin = '';}
        if ($model->event_date_end) {
            $end_format = EntityDateFormat::viewFormat($model->id,$model->event_date_end,'end');
            $event_date_end = Helper::gmdate($end_format,$model->event_date_end,false);
            $model->event_date_end = $event_date_end['date'];
            $date_model->d_2 = $event_date_end['age'];
        }
        else { $model->event_date_end = '';}

        if (($model_video = VideoContent::findOne(['entity_id' => $id])) == NULL) {
            $model_video = new VideoContent();
        }

        if (($model_pdf = PdfContent::findOne(['entity_id' => $id])) == NULL) {
            $model_pdf = new PdfContent();
        }

        $entity_type_id = $model->entity_type_id;
        $model->setEav();

        $properties = EntityProperty::find()->where(['entity_type_id' => $entity_type_id])->all();
        $properties_map = ArrayHelper::map($properties,'id','title');
        $languages = Lang::find()->orderBy('id DESC')->all();

        //свойства_begin
        $article_eav = EntityEav::find()->where(['entity_id' => $id])->all();
        foreach ($article_eav as $temp) {
            $temp_eav[$temp->property_id][$temp->lang_id] = $temp->value;
        }

        foreach ($languages as $lang) {
            foreach ($properties as $property) {
                $model_eav[$property->id][$lang->id] = EntityEav::findOne(['property_id' => $property->id, 'lang_id' => $lang->id, 'entity_id' => $id]);
                if (!isset($model_eav[$property->id][$lang->id])) {
                    $model_eav[$property->id][$lang->id] = new EntityEav();
                    $model_eav[$property->id][$lang->id]->entity_id = $id;
                    $model_eav[$property->id][$lang->id]->property_id = $property->id;
                    $model_eav[$property->id][$lang->id]->lang_id = $lang->id;
                    $model_eav[$property->id][$lang->id]->value = isset($temp_eav[$property->id][$lang->id]) ? trim($temp_eav[$property->id][$lang->id]) : '';
                }
            }
        }
        //свойства_end

        //контент_begin
		$model_content = [];
        $model_image_eav = [];
        $article_content = ArticleContent::find()->where(['article_id' => $id])->orderBy('sequence ASC')->all();

        foreach ($languages as $lang_key => $lang) {
            foreach ($article_content as $index_a_c => $content_textarea) {
                if ($content_textarea->content_type == 1) {//если текст
                    $model_content[$content_textarea->sequence][$lang->id] = ArticleContentValue::findOne(['content_id' => $content_textarea->id, 'lang_id' => $lang->id]);
                }
            }
        }
        foreach ($article_content as $index_a_c => $content_textarea) {
            if ($content_textarea->content_type == 2) {
                $model_content[$content_textarea->sequence] = ArticleContentImage::findOne(['content_id' => $content_textarea->id]);
                $model_image_eav[$content_textarea->sequence] = ArticleContentImageEav::findAll(['image_id' => $model_content[$content_textarea->sequence]->id]);
            }
        }
        ksort($model_content);
        //контент_end
        $request = Yii::$app->request;

        $thumbnail = $model->thumbnail;

        if ($model->load($request->post())) {
            $thumb_file = UploadedFile::getInstance($model,"thumbnail");
            if($thumb_file) {

                if (!file_exists(Yii::getAlias('@web').$this->uploadThumbStyleDir)) {
                    mkdir(Yii::getAlias('@web').$this->uploadThumbStyleDir);
                }
                $thumbnail = md5($thumb_file->baseName. date("YmdHms")) .'.'. $thumb_file->extension;

                $thumb_file->saveAs(Yii::getAlias('@webroot/files/thumb/').$thumbnail);
                Image::thumbnail(Yii::getAlias('@webroot/files/thumb/').$thumbnail , 280, 230)
                    ->save(Yii::getAlias('@webroot').'/'.$this->uploadThumbStyleDir.$thumbnail, ['quality' => 50]);
            }
            $date_model->load($request->post());
            $model->thumbnail = $thumbnail;

            $date_model->load(Yii::$app->request->post());

            $start_date = $model->event_date_begin;
            $end_date = $model->event_date_end;

            $model->event_date_begin = $this->strToDate($start_date,$date_model->d_1);
            $model->event_date_end = $this->strToDate($end_date,$date_model->d_2);

            $model->save();

            EntityDateFormat::saveFormat($model->id,$start_date,'begin');
            EntityDateFormat::saveFormat($model->id,$end_date,'end');

            $subcategories = $request->post('subcategory');
            $model->setSubSubjects($subcategories);

            $model->saveRelatedProducts($_POST['EntityRelated']['related_entity_id']);

            foreach ($_POST['EntityEav'] as $lang_key=>$lang) {
                foreach ($properties_map as $prop_key=>$property) {
                    $ent_prop = EntityProperty::findOne(['id' => $model_eav[$prop_key][$lang_key]->property_id]);
                    if ($ent_prop->type_id == 3)
                    {//тэги
                        if ($lang[$prop_key]['value'])
                        {
                            foreach ($lang[$prop_key]['value'] as $value) {
                                //EntityTags::deleteAll(['entity_id' => $model->id]);
                                if (($tag = EntityTags::findOne(['entity_id' =>$model->id, 'lang_id' => $lang_key,'tag'=>$value])) == NULL) {$tag = new EntityTags();}
                                $tag->tag = $value;
                                $tag->entity_id = $model->id;
                                $tag->lang_id = $lang_key;
                                $tag->save();
                            }
                        }
                    }
                    else
                    { //text и string
                        $model_eav[$prop_key][$lang_key]->value = $lang[$prop_key]['value'];
                        if($ent_prop->name == 'title')
                            $model_eav[$prop_key][$lang_key]->value = trim($model_eav[$prop_key][$lang_key]->value);
                        $model_eav[$prop_key][$lang_key]->entity_id = $model->id;
                        $model_eav[$prop_key][$lang_key]->save();
                    }
                }
            }

            if ($entity_type_id == 1) {
                if (!empty($_POST['ArticleContentValue'])) {
                    foreach ($_POST['ArticleContentValue'] as $key=>$value) { //обновление контента
                        $article_content_new_id = 0;
                        foreach ($value as $lang_key => $property) {
                            if (empty($model_content[$key][$lang_key]))
                            {
                                if (ArticleContentValue::findOne(['content_id'=>$article_content_new_id]) == null) {
                                    $article_content_new = new ArticleContent();
                                    $article_content_new->article_id = $id;
                                    $article_content_new->content_type = 1;
                                    $article_content_new->sequence = $key;
                                    $article_content_new->save();
                                    $article_content_new_id = $article_content_new->id;
                                }

                                $model_content[$key][$lang_key] = new ArticleContentValue();
                                $model_content[$key][$lang_key]->content_id = $article_content_new_id;
                                $model_content[$key][$lang_key]->value = Html::encode($property['value']);
                                $model_content[$key][$lang_key]->lang_id = $lang_key;
                                $model_content[$key][$lang_key]->save();
                            }
                            else
                            {
                                $model_content[$key][$lang_key]->value = Html::encode($property['value']);
                                $model_content[$key][$lang_key]->save();
                            }
                        }
                    }
                }

                if (!empty($_FILES['ArticleContentImage'])) {
                    foreach ($_FILES['ArticleContentImage']['name'] as $key => $img) {
                        $img_iindex = $key;
                        if (empty($model_content[$key])) {
                            $article_content_new = new ArticleContent();
                            $article_content_new->article_id = $model->id;
                            $article_content_new->content_type = 2;
                            $article_content_new->sequence = $img_iindex;
                            $article_content_new->save();

                            $model_content_image = new ArticleContentImage();
                            $img_file = UploadedFile::getInstance($model_content_image,"[{$img_iindex}]filename");
                            if (!empty($img_file)) {
                                $filename = md5($img_file->baseName. date("YmdHms")) .'.'. $img_file->extension;
                                $img_file->saveAs($this->uploadDir.$filename);
                                $model_content_image->filename = $filename;
                            } else {$model_content_image->filename ='non-image.jpg';}
                            $model_content_image->content_id = $article_content_new->id;
                            $model_content_image->save();

                            foreach ($languages as $lang) {
                                $model_content_image_eav = new ArticleContentImageEav();
                                $model_content_image_eav->image_id = $model_content_image->id;
                                $model_content_image_eav->lang_id = $lang->id;
                                if (mb_strlen($_POST['ArticleContentImageEav'][$img_iindex][$lang->id]['title']) > 200) {
                                    $img_title = mb_substr($_POST['ArticleContentImageEav'][$img_iindex][$lang->id]['title'],0,200);
                                }
                                else {
                                    $img_title = $_POST['ArticleContentImageEav'][$img_iindex][$lang->id]['title'];
                                }
                                $model_content_image_eav->title = $img_title;
                                $model_content_image_eav->description = $_POST['ArticleContentImageEav'][$img_iindex][$lang->id]['description'];
                                $model_content_image_eav->save();
                            }
                        } else {
                            if ($i_file = UploadedFile::getInstance($model_content[$img_iindex],"[{$img_iindex}]filename") !== null)
                            {
                                $filename = $model_content[$img_iindex]->filename;
                                $i_file = UploadedFile::getInstance($model_content[$img_iindex],"[{$img_iindex}]filename");
                                if ($filename == 'non-image.jpg')  $filename = md5($i_file->baseName. date("YmdHms")) .'.'. $i_file->extension;
                                $i_file->saveAs($this->uploadDir.$filename);
                                $model_content[$img_iindex]->filename =$filename;
                                $model_content[$img_iindex]->save();
                            }

                            foreach ($languages as $lang) {
                                $model_content_image_eav = ArticleContentImageEav::findOne(['lang_id' => $lang->id, 'image_id' => $model_content[$img_iindex]->id]);
                                $model_content_image_eav->title = $_POST['ArticleContentImageEav'][$img_iindex][$lang->id]['title'];
                                $model_content_image_eav->description = $_POST['ArticleContentImageEav'][$img_iindex][$lang->id]['description'];
                                $model_content_image_eav->save();
                            }
                        }

                    }
                }
            }

            if ($entity_type_id == 2) {
                if (!empty($_FILES['VideoContent'])) {
                    if (!empty($_FILES['VideoContent']['name']['filename'])) {
                        $video_file = UploadedFile::getInstance($model_video,"filename");
                        $filename = md5($video_file->baseName. date("YmdHms")) .'.'. $video_file->extension;
                        $video_file->saveAs($this->uploadVideoDir.$filename);
                        $model_video->entity_id = $model->id;
                        $model_video->filename = $filename;
                        $model_video->save();
                    }
                }
            }

            if ($entity_type_id == 4) {
                if (!empty($_FILES['PdfContent'])) {
                    if (!empty($_FILES['PdfContent']['name']['filename'])) {
                        $pdf_file = UploadedFile::getInstance($model_pdf,"filename");
                        $filename = md5($pdf_file->baseName. date("YmdHms")) .'.'. $pdf_file->extension;
                        $pdf_file->saveAs($this->uploadPdfDir.$filename);
                        $model_pdf->entity_id = $model->id;
                        $model_pdf->filename = $filename;
                        $model_pdf->save();
                    }
                }
            }


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if ($entity_type_id == 1) {
                return $this->render('update', [
                    'model' => $model,
                    'model_eav' => $model_eav,
                    'model_video' => $model_video,
                    'model_pdf' => $model_pdf,
                    'model_content' => $model_content,
                    'model_image_eav' => $model_image_eav,
                    'date_model' => $date_model,
                    'model_related' => $model_related,
                ]);
            }
            if ($entity_type_id == 2) {
                return $this->render('update', [
                    'model' => $model,
                    'model_eav' => $model_eav,
                    'model_video' => $model_video,
                    'model_pdf' => $model_pdf,
                    'date_model' => $date_model,
                    'model_related' => $model_related,
                ]);
            }

            if ($entity_type_id == 4) {
                return $this->render('update', [
                    'model' => $model,
                    'model_eav' => $model_eav,
                    'model_video' => $model_video,
                    'model_pdf' => $model_pdf,
                    'date_model' => $date_model,
                    'model_related' => $model_related,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Entity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Entity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Entity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Entity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }

    /**
     * Generate slug for
     */
    public function actionGenerateSlug($id = NULL)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $str = Yii::$app->request->post('title');
            if(!is_null($id)) {
                if($id <= 0 || $id != (int)$id)
                    $id = NULL;
            }
            $slug =Helper::createSlug($str);

            $entity = Entity::findOne(['slug' => $slug]);
            while ($entity && (is_null($id) || $entity->id != $id)) {
                $slug .= '-1';
                $entity = Entity::findOne(['slug' => $slug]);
            }
            return ['slug' => $slug];
        }
        else {
            throw new NotFoundHttpException('Not valid request.');
        }
    }
    public function actionGenerateContentBlock()
    {
        if (Yii::$app->request->isAjax) {
            $content_id = intval($_POST['seq'])+1;
            return $this->renderAjax('_imperavi',['seq_index' => $content_id]);
        }
        else {
            throw new NotFoundHttpException('Not valid request.');
        }
    }
    public function actionGenerateContentImage()
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_fileinput');
        }
        else {
            throw new NotFoundHttpException('Not valid request.');
        }
    }

    protected function actionCheckDateField($dat)
    {
        if (empty($dat)) {
            return '';
        }

    }

    public function actionGenerateContentAudio()
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_audioinput');
        }
        else {
            throw new NotFoundHttpException('Not valid request.');
        }
    }
    public function actionImperaviLinkes()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if (($lang_id = Yii::$app->request->post('lang_id')) == NULL) {$lang_id = 3;}

            $lurl = Lang::find()->select('url')->where(['id' => $lang_id])->scalar();

            $entities = Entity::find()->where(['entity_type_id' => 1, 'status' => 1])->all();

            $result='';

            foreach ($entities as $entity) {
                $resid[] = GetEntity::getEntityPropertiesByLang($entity->id,$lang_id);
            }

            ArrayHelper::multisort($resid,'title');

            foreach ($resid as $res) {
                if (isset($res['title'])) {
                    if ($res['title'] != '') {
                        $result.= '<option data-id='.$res['id'].' value=/'.$lurl.'/encyclopedia/'.$res['slug'].'>'.$res['title'].'</option>';
                    }
                }
            }
            return $result;
        }
        else {
            throw new NotFoundHttpException('Not valid request.');
        }
    }

    public function actionAjaxRelatedProduct()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $result = [
            'more' => false,
            'results' => []
        ];
        $results = [];

        $search = Yii::$app->request->get('search');
        if (!empty($search['term'])) {
            $query = new \yii\db\Query();

            $query->select('id, title AS text')->from(Entity::tableName())->andWhere(
                ['like', 'title', $search['term']]
            )->andWhere(['status' => 1])->orderBy(['title' => SORT_ASC]);
            $command = $query->createCommand();
            $data = $command->queryAll();

            $result['results'] = array_values($data);
        }

        return $result;
    }
    public function actionDelete_tag()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $text = Yii::$app->request->post('title');
        $entity_id = Yii::$app->request->post('id');
        $lang_id = Yii::$app->request->post('lang');
        EntityTags::deleteAll(['entity_id' => $entity_id, 'tag' => $text,'lang_id' => $lang_id]);
        return true;
    }

    public function actionDelete_thumb()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $filename = Yii::$app->request->post('filename');
        $entity_id = Yii::$app->request->post('id');
        $entity = Entity::findOne($entity_id);
        $entity->thumbnail = '';
        $entity->save();
        return true;
    }

}
