<?php

namespace app\controllers;

use app\backend\models\Entity;
use app\models\SubscribeEmail;
use yii\db\Expression;
use yii\helpers\VarDumper;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class SubscribeController extends Controller
{

    public function actionIndex()
    {
        $request = Yii::$app->request;
        $model = new SubscribeEmail();

        if ($request->isAjax) {
            if($model->load(\Yii::$app->request->post())){
                if ($model->save()) {
                    return 'success';
                }
            }
        }

        throw new NotFoundHttpException('Page not Found');
    }

//    public function actionIndex2()
//    {
//        global $config;
//        $config['params']['entity_type_for_eav'] = 'article';
//
//        $entities = Entity::find()
//            ->where(['status' => 1])
//            ->innerJoinWith(['eav'])
//            ->orderBy(new Expression('rand()'))
//            ->limit(10)
//            ->all();
//
//        $str = '';
//
//        foreach ($entities as $entity) {
//            $str.= '<a href="http://tatarile.tatar'.\app\components\UrlHelper::createEntityUrl($entity->id).'">' . $entity->eav->value . '</a><br>';
//        }
//        echo $str;
//    }
}
