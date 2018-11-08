<?php

namespace app\controllers;

use app\backend\models\Entity;
use app\backend\models\EntityTags;
use app\backend\models\EntityType;
use app\backend\models\Subject;
use app\components\Helper;
use app\helpers\ThemeHelper;
use app\models\Lang;
use Yii;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;

class SearchController extends ThemeController
{
    public $themeName;

    public function init()
    {
        parent::init();
        $this->themeName = ThemeHelper::defaultTheme();
        $this->layout = '@app/themes/'.$this->themeName.'/layouts/main';
    }

    public function actionIndex($type = NULL)
    {
//        VarDumper::dump(\Yii::$app->getView()->theme, 5, true);
//        exit();
        Url::remember();
        $request = Yii::$app->request;
        $offset = 0;
        $limit = 12;
        $pagination = false;
        $search_q = trim($request->get('q'));
        $is_auto_complete = false;
        if(mb_strlen($request->get('term')) > 0) {
            if($request->isAjax) {
                $search_q = trim($request->get('term'));
                $is_auto_complete = true;
                $limit = 5;
            }
        }
        $lang = \app\models\Lang::getCurrent();
        $lang_url = "";
        if($lang->id != 2) {
            $lang_url = '/'.$lang->url;
        }
        $tagSearch = (mb_substr($search_q,0,1) == '#');
        $yearMin = -2201;
        $yearMax = gmdate("Y");
        $dateFilter = false;
        $dateStart = $request->get('date-start');
        $dateEnd = $request->get('date-end');
        $parentSubjects = Subject::getAllSubjectsWithLang();
        if($dateStart != '' && $dateEnd != '')
            $dateFilter = true;

        $dateStart = (int)$dateStart;
        $dateEnd = (int)$dateEnd;
        $char = mb_strtolower($request->get('char'));
        if(!in_array($char,(array)Yii::t('app','alphabet')))
            $char = '';
        if($dateStart == 0 || $dateStart < $yearMin || $dateStart > $yearMax) $dateStart = $yearMin;
        if($dateEnd == 0 || $dateEnd > $yearMax || $dateEnd < $yearMin) $dateEnd = $yearMax;
        if($dateStart > $dateEnd) $dateEnd = $dateStart;
        $dateStartTS = Helper::strtotime($dateStart,$dateStart > 0);
        $dateEndTS = Helper::strtotime($dateEnd,$dateEnd > 0,true);
        $popular = $request->get('popular') == 'on';

        $category_id = (int)$request->get('category_id');
        if($category_id < 0 || !isset($parentSubjects[$category_id]))
            $category_id = 2;

        if($request->get('pagination') == 1) $pagination = true;
        if($request->isAjax && $pagination) {
            $page = $request->get('page');
            if($page != (int)$page || $page <=0)
                $page = 1;
            $offset = ($page-1)*$limit;
        }
        $query = Entity::find()->where(['entity.status'=>1]);
        $entityTypes = EntityType::find();
        if($type == 'encyclopedia')
            $entityTypes = $entityTypes->where(['id' => 1]);
        elseif($type == 'library') {
            $entityTypes = $entityTypes->where(['<>','id',1]);
        }
        $entityTypes = $entityTypes->all();
        $selectedTypes = [];
        $entity_type_get = $request->get('entity_type');
        if(is_array($entity_type_get) && count($entity_type_get) > 0) {
            foreach ($entityTypes as $entityType) {
                if(isset($entity_type_get[$entityType->id]))
                    $selectedTypes[$entityType->id] = 1;
            }
        }

        $selectedSubcat = [];
        $subcats = [];
        $subcategory_get = $request->get('subcategories');
        if($category_id > 0 ) {
            $subcats = Subject::getAllSubSubjectsWithLang($category_id);
            if(is_array($subcategory_get) && count($subcategory_get) > 0) {
                foreach ($subcats as $subcatID => $subcatTitle) {
                    if(isset($subcategory_get[$subcatID]))
                        $selectedSubcat[$subcatID] = 1;
                }
            }
        }

        $entities = $query->orderBy('entity.id')
            ->offset($offset)
            ->limit($limit+1)
            ->innerJoin('entity_property AS entity_property_title',"`entity_property_title`.`entity_type_id` = `entity`.`entity_type_id` AND `entity_property_title`.`name`= 'title'")
            ->innerJoin('entity_property AS entity_property_annot',"`entity_property_annot`.`entity_type_id` = `entity`.`entity_type_id` AND `entity_property_annot`.`name`= 'annotation'");
        $notNullStr = "";
        $likeStr = "";
        $charLikeStr = "";
        for ($i = 0; $i<count($entityTypes); $i++) {
            if(count($selectedTypes) == 0 || isset($selectedTypes[$entityTypes[$i]->id])) {
                $entities = $entities
                    ->leftJoin('entity_eav_'.$entityTypes[$i]->entity_type.' AS entity_eav_'.$entityTypes[$i]->entity_type.'_title',"`entity_eav_".$entityTypes[$i]->entity_type."_title`.`property_id` = `entity_property_title`.`id` AND `entity_eav_".$entityTypes[$i]->entity_type."_title`.`lang_id` = '".Lang::getCurrent()->id."' AND `entity_eav_".$entityTypes[$i]->entity_type."_title`.`entity_id` = `entity`.`id` AND `entity_eav_".$entityTypes[$i]->entity_type."_title`.`value` <> ''")
                    ->leftJoin('entity_eav_'.$entityTypes[$i]->entity_type.' AS entity_eav_'.$entityTypes[$i]->entity_type.'_annot',"`entity_eav_".$entityTypes[$i]->entity_type."_annot`.`property_id` = `entity_property_annot`.`id` AND `entity_eav_".$entityTypes[$i]->entity_type."_annot`.`lang_id` = '".Lang::getCurrent()->id."' AND `entity_eav_".$entityTypes[$i]->entity_type."_annot`.`entity_id` = `entity`.`id`");
                if(strlen($notNullStr) != 0) {
                    $notNullStr .= ' OR ';
                }
                if(strlen($likeStr) != 0) {
                    $likeStr .= ' OR ';
                }
                if(strlen($charLikeStr) != 0) {
                    $charLikeStr .= ' OR ';
                }
                $notNullStr .= '`entity_eav_'.$entityTypes[$i]->entity_type.'_title`.`id` IS NOT NULL';
                $likeStr .= "`entity_eav_".$entityTypes[$i]->entity_type."_title`.`value` LIKE :q";
                $likeStr .= " OR `entity_eav_".$entityTypes[$i]->entity_type."_annot`.`value` LIKE :q";
                $charLikeStr .="`entity_eav_".$entityTypes[$i]->entity_type."_title`.`value` LIKE :char OR `entity_eav_".$entityTypes[$i]->entity_type."_title`.`value` LIKE :charQuote1 OR `entity_eav_".$entityTypes[$i]->entity_type."_title`.`value` LIKE :charQuote2 OR `entity_eav_".$entityTypes[$i]->entity_type."_title`.`value` LIKE :charQuote3 OR `entity_eav_".$entityTypes[$i]->entity_type."_title`.`value` LIKE :charQuote4";
            }
        }
        $entities = $entities->andWhere($notNullStr);
        $entitiesPop = clone $entities;
        $entitiesPop = $entitiesPop
            ->offset(0)
            ->limit(3)
            ->innerJoin('entity_statistics','`entity_statistics`.`entity_id` = `entity`.`id`')
            ->orderBy('`entity_statistics`.`points` DESC');

        if(strlen($search_q) > 0) {
            if(!$tagSearch)
                $entities = $entities->andWhere($likeStr,[':q' => '%'.$search_q.'%']);
            else {
                $search_q_a = explode('#',$search_q);
                $notNullStr_q_a = "";
                for($i = 1; $i<count($search_q_a); $i++) {
                    $search_q_a[$i] = trim($search_q_a[$i]);
                    if(strlen($search_q_a[$i]) > 0) {
                        if(strlen($notNullStr_q_a) != 0) {
                            $notNullStr_q_a .= ' OR ';
                        }
                        $entities = $entities->leftJoin("`entity_tags` AS `entity_tags_".$i."`","`entity_tags_".$i."`.`entity_id` = `entity`.`id` AND `entity_tags_".$i."`.`lang_id` ='".Lang::getCurrent()->id."' AND TRIM(`entity_tags_".$i."`.`tag`) = TRIM(:q_".$i.")",[":q_".$i => $search_q_a[$i]]);
                        $notNullStr_q_a .= "`entity_tags_".$i."`.`id` IS NOT NULL";
                    }
                }
                $entities = $entities->andWhere($notNullStr_q_a);
            }
        }
        if(strlen($char) > 0)
            $entities = $entities->andWhere($charLikeStr,[
                ':char' => $char.'%',
                ':charQuote1' => '«'.$char.'%',
                ':charQuote2' => '"'.$char.'%',
                ':charQuote3' => "'".$char."%",
                ':charQuote4' => '‘'.$char."%"
            ]);
        if($dateFilter)
            $entities = $entities->andWhere("`entity`.`event_date_begin` BETWEEN :datebegin and :dateend OR `entity`.`event_date_end` BETWEEN :datebegin and :dateend",[':datebegin' => $dateStartTS,':dateend' => $dateEndTS]);
        if($category_id > 0)
            $entities = $entities->andWhere("`entity`.`category_id` = :category_id",[':category_id' => $category_id]);
        if(count($selectedSubcat) > 0) {
            $subcatStr = "";
            foreach ($selectedSubcat as $selectedSubcatID => $it) {
                if(strlen($subcatStr) != 0) {
                    $subcatStr .= ' OR ';
                }
                $subcatStr .= "`entity_subsubject_eav`.`subject_id` = '".$selectedSubcatID."'";
            }
            $entities = $entities->innerJoin('entity_subsubject_eav','`entity_subsubject_eav`.`entity_id` = `entity`.`id` AND ('.$subcatStr.')');
        }
        if($popular) {
            $entities = $entities->innerJoin('entity_statistics','`entity_statistics`.`entity_id` = `entity`.`id`');
            $entities = $entities->orderBy('`entity_statistics`.`points` DESC');
        }
        $entities = $entities->all();

        if($request->isAjax){
            if($is_auto_complete) {
                return $this->renderPartial('search-list-autocomplete',[
                    'entities' => $entities
                ]);
            }
            else {
                return $this->renderPartial('search-list',[
                    'entities' => $entities,
                    'entity_types' => $entityTypes,
                    'selected_types' => $selectedTypes,
                    'limit' => $limit,
                    'pagination' => $pagination,
                    'search_q' => $search_q,
                    'dateStart' => $dateStart,
                    'dateEnd' => $dateEnd,
                    'dateFilter' => $dateFilter,
                    'parentSubjects' => $parentSubjects,
                    'category_id' => $category_id,
                    'subcats' => $subcats,
                    'selectedSubcat' => $selectedSubcat,
                    'type' => $type,
                    'char' => $char,
                    'popular' => $popular,
                    'entitiesPop' => $entitiesPop,
                    'lang_url' => $lang_url
                ]);
            }
        } else {
            if ($request->get('pagination')) {
                return $this->redirect(Url::toRoute('/encyclopedia'));
            }
        }

        return $this->render('index', [
            'entities' => $entities,
            'entity_types' => $entityTypes,
            'selected_types' => $selectedTypes,
            'limit' => $limit,
            'pagination' => $pagination,
            'search_q' => $search_q,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
            'dateFilter' => $dateFilter,
            'parentSubjects' => $parentSubjects,
            'category_id' => $category_id,
            'subcats' => $subcats,
            'selectedSubcat' => $selectedSubcat,
            'type' => $type,
            'char' => $char,
            'popular' => $popular,
            'entitiesPop' => $entitiesPop,
            'lang_url' => $lang_url
        ]);
    }
    public function actionUpdateTags()
    {
        $request = Yii::$app->request;
        $randomHashTags = [];
        if($request->isAjax) {
            $lang = \app\models\Lang::getCurrent();
            $lang_url = "";
            if($lang->id != 2) {
                $lang_url = '/'.$lang->url;
            }
            for($i = 0; $i<3; $i++) {
                $notTag = "";
                if(count($randomHashTags) > 0) {
                    foreach ($randomHashTags as $randomHashTagN) {
                        if(strlen($notTag) > 0)
                            $notTag .=" AND ";
                        $notTag .= "`tag` <>'".$randomHashTagN->tag."'";
                    }
                }
                $randomHashTag = EntityTags::find()
                    ->where(['lang_id' => \app\models\Lang::getCurrent()->id])
                    ->andWhere($notTag)
                    ->offset(0)->limit(1)
                    ->orderBy(new \yii\db\Expression('rand()'))
                    ->all();
                if(count($randomHashTag) > 0)
                    $randomHashTags[] = $randomHashTag[0];
            }
            /*$randomHashTags = \app\backend\models\EntityTags::find()
                ->where([
                    'lang_id' => \app\models\Lang::getCurrent()->id
                ])
                ->groupBy(['tag','id'])
                ->offset(0)->limit(3)
                ->orderBy(new \yii\db\Expression('rand()'))->all();*/
            return $this->renderPartial('random-tagslist',[
                'randomHashTags' => $randomHashTags,
                'lang_url' => $lang_url
            ]);
        }
        else {
            throw new BadRequestHttpException();
        }
    }
}
