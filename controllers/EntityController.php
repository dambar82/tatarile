<?php

namespace app\controllers;

use app\backend\models\ArticleContent;
use app\backend\models\ArticleContentImageEav;
use app\backend\models\Entity;
use app\backend\models\EntityCalendar;
use app\backend\models\EntityRelated;
use app\backend\models\EntityStatistics;
use app\backend\models\EntityTags;
use app\backend\models\VideoContent;
use app\components\GetEntity;
use app\components\UrlHelper;
use app\models\Lang;
use app\modules\admin\models\PdfContent;
use app\modules\user\models\UserFavorite;
use webvimark\modules\UserManagement\models\User;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\JsonResponseFormatter;
use yii\web\NotFoundHttpException;

class EntityController extends Controller
{
    public $freeAccess = true;
    public $viewFile = 'index';


    public function actionProduct($id)
    {
        if (!isset($id)) {
            throw new NotFoundHttpException('The requested page does not exist. id');
        }

        if (($model = Entity::findOne($id)) == null) {
            return $this->render('error');
        }
        $model_eav = GetEntity::getEntityProperties($id);

        if ((!isset($model_eav)) || (empty($model_eav))) {
            return $this->render('error');
        }

        if ($model_eav['title'] == NULL) {
            return $this->render('error');
        }

        $related_model = EntityRelated::find()->where(['entity_id' => $id])->all();
        if ($related_model) {
            $related_model = EntityRelated::relatedEntity($related_model);
        }

        $user = \webvimark\modules\UserManagement\models\User::getCurrentUser();
        $favorite_active='';
        $showHide = false;
        if($user) {
            $model->viewingAction($user->id);
            if (($favorite = UserFavorite::findOne(['user_id' => $user->id,'entity_id' => $id])) !== NULL) {
                $favorite_active = 'adding';
            }

            if (User::hasRole('access_pdf', $superAdminAllowed = false)) {
                $showHide = true;
            }
        }
        else {
            $model->viewingAction();
        }

        $tags_model = EntityTags::find()->where(['entity_id' => $id, 'lang_id' => Lang::getCurrent()->id])->all(); //тэги

        $entity_today = EntityCalendar::getTodayEntity($model->entity_type_id); //статья дня

        $this->view->registerMetaTag(['description' => strip_tags($model->description)]);
        $this->view->registerMetaTag(['keywords' => $model->keywords]);
        $this->view->title = $model_eav['title'];

        $this->view->registerMetaTag(['property' => 'og:title','content' => $model_eav['title']]);
        $this->view->registerMetaTag(['property' => 'og:description','content' => strip_tags($model->description)]);
        if ($model->thumbnail) {
            $this->view->registerMetaTag(['property' => 'og:image','content' => \Yii::getAlias('@web/files/280x230/').$model->thumbnail]);
        }
        else {
            $this->view->registerMetaTag(['property' => 'og:image','content' => \Yii::getAlias('@web/images/').'about_logo.jpg']);
        }

        $this->view->registerMetaTag(['property' => 'og:url','content' => Yii::$app->params['siteURL'].\app\components\UrlHelper::createEntityUrl($model->id)]);

        if ($model->entity_type_id == 1) {
            $this->viewFile = '_article';
            $content = $this->articleContent($id);
        }

        if ($model->entity_type_id == 2) {
            $this->viewFile = '_video';
            $content = $this->videoContent($id);
        }

        if ($model->entity_type_id == 4) {
            $this->viewFile = '_pdf';
            $content = $this->pdfContent($id);
        }



        return $this->render('page', [
            'model' => $model,
            'model_eav' => $model_eav,
            'content' => $content,
            'related_model' => $related_model,
            'tags_model' => $tags_model,
            'entity_today' => $entity_today,
            'viewFile' => $this->viewFile,
            'user' => $user,
            'favorite_active' => $favorite_active,
            'showHide' => $showHide
        ]);
    }

    public function actionRandomEntry()
    {
        if (($type = Html::encode(Yii::$app->request->get('type'))) == NULL) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if (!ArrayHelper::isIn($type,['encyclopedia','library','all'])) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $entity = Entity::find()->select('id')->where(['status' => 1]);

        if ($type == 'encyclopedia') {
            $entity->andWhere(['entity_type_id' => 1]);
        }

        if ($type == 'library') {
            $entity->andWhere(['<>','entity_type_id', 1]);
        }

        $entity = $entity->all();

        if (!$entity) {
            throw new NotFoundHttpException('Not data.');
        }

        $rand_entity = rand(0,count($entity)-1);
        $rand_entity = $entity[$rand_entity]->id;

        while (($property = GetEntity::getEntityTitle($rand_entity)) == '') {
            $rand_entity = rand(0,count($entity)-1);
            $rand_entity = $entity[$rand_entity]->id;
        }

        $url = UrlHelper::createEntityUrl($rand_entity);

        return $this->redirect($url);
    }

    protected function videoContent($id)
    {
        $video_content = VideoContent::findOne(['entity_id' => $id]);
        if (!empty($video_content)) {
            $video_content->filename = Yii::getAlias('@web/files/video/').$video_content->filename;
        }
        return $video_content;
    }

    protected function pdfContent($id)
    {
        $pdf_content = PdfContent::findOne(['entity_id' => $id]);
        if (!empty($pdf_content)) {
            $pdf_content->filename = Yii::getAlias('@web').'/files/pdf/'.$pdf_content->filename;
        }
        return $pdf_content;
    }

    protected function articleContent($id)
    {
        $mr =[];
        $content_article =[];
        $content_image =[];
        $object_result = NULL;

        $content_article = ArticleContent::find()
            ->joinWith('content')
            ->where(['article_content.article_id' => $id,'article_content.content_type' => 1])
            ->all();

        $content_image = ArticleContent::find()
            ->joinWith('image')
            ->where(['article_content.article_id' => $id,'article_content.content_type' => 2])
            ->all();
        $content = ArrayHelper::merge($content_article,$content_image);

        if (!empty($content)) {
            foreach ($content as $item) {
                $object_result[intval($item->sequence)] =  $item;
            }
        }

        if ($object_result)
            ksort($object_result);

        $result[]=['type' => ''];
        if ($object_result !== NULL) {
            $current_lang = Lang::getCurrent();

            foreach ($object_result as $key=>$value) {
                if ($value->content_type == 1) {
                    $result[$key]['sort'] = $key;
                    $result[$key]['type'] = 'text';
                    $result[$key]['value'] = $value->content[0]->value;
                }
                else {
                    $result[$key]['sort'] = $key;
                    $result[$key]['type'] = 'image';
                    $result[$key]['value'] = Yii::getAlias('@web/files/articles/').$value->image[0]->filename;
                    $result[$key]['title'] = ArticleContentImageEav::find()->select('title')->where(['lang_id'=>$current_lang->id,'image_id' => $value->image[0]->id])->scalar();
                    $result[$key]['description'] = ArticleContentImageEav::find()->select('description')->where(['lang_id'=>$current_lang->id,'image_id' => $value->image[0]->id])->scalar();
                }
            }

            $result[]=['type' => ''];
            $simular = NULL;

            if ($result) {
                $index = 0;
                foreach ($result as $key => $res) {
                    if (isset($res['value'])) {
                        if (($res['type'] == 'text') & (!empty($res['value']))){
                            $index++;
                            $mr[$index]['type'] = 'text';
                            $mr[$index]['value'] = $res['value'];

                            if (($s = $this->getSimilar($res['value'])) !== NULL) {
                                $simular[] = $s;
                            }
                            $index++;
                        } else {
                            if ((($result[$key+1]['type'] == 'image') || ($result[$key-1]['type'] == 'image')) & (!empty($res['value']))) {

                                $mr[$index]['type'] = 'imagearray';
                                $mr[$index]['value'][] = ['filename' => $res['value'],'title' => $res['title'],'description' => $res['description']];
                            }
                            else {
                                if (!empty($res['value'])) {
                                    $mr[$index]['type'] = 'image';
                                    $mr[$index]['value'][] = ['filename' => $res['value'],'title' => $res['title'],'description' => $res['description']];
                                    $index++;
                                }
                                else $index++;
                            }
                        }
                    }
                }

            }
        }
        $sim = NULL;
        $simular_result = NULL;
        if (!empty($simular)) {
            foreach ($simular as $item){
                foreach ($item as $i) {
                    $sim[] = $i;
                }
            }
            if ($sim) {
                $sim = array_unique($sim);
                foreach ($sim as $key=>$s) {
                    $sim_key = GetEntity::getEntityProperties($s);
                    if (!empty($sim_key['title'])) {
                        $simular_result[] = $sim_key;
                    }
                }
                ArrayHelper::multisort($simular_result, 'title', SORT_ASC);
            }
        }

        $article['content'] = $mr;
        $article['simular'] = $simular_result;

        return $article;
    }

    protected function getSimilar($text)
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);
        $dom->loadHTML(Html::decode($text));

        $res = NULL;
        foreach ($dom->getElementsByTagName('a') as $node) {
            if ($node->hasAttribute('data-id')) {
                $res[] = $node->getAttribute('data-id');

            }
        }
        return $res;
    }
    public function actionEntityVoting($id)
    {
        $id = (int)$id;
        $sum = (int)Yii::$app->request->post('sum');
        $resp = [
            'success' => 0,
            'msg' => 'Error',
            'msg_title' => 'Error'
        ];
        if($id > 0 && $sum > 0 && $sum <=5) {
            $user = \webvimark\modules\UserManagement\models\User::getCurrentUser();
            if($user) {
                $model = Entity::findOne(['status' => 1, 'id' => $id]);
                if($model) {
                    $model->vote($user->id,$sum);
                    $resp['success'] = 1;
                    $resp['msg'] = 'vote is saved';
                    $resp['msg_title'] = 'vote is saved';
                    $ent_stat = EntityStatistics::findOne(['entity_id' => $model->id]);
                    $resp['vote_avg'] = $ent_stat->votes_count > 0?$ent_stat->votes_sum/$ent_stat->votes_count:0;
                }
            }
        }
        return json_encode($resp);
    }

}
