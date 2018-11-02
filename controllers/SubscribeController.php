<?php

namespace app\controllers;

use app\models\SubscribeEmail;
use yii\helpers\HtmlPurifier;
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
                $model->hash = Yii::$app->security->generateRandomString(20);
                if ($model->save()) {
                    return 'success';
                }
            }
        }

        throw new NotFoundHttpException('Page not Found');
    }

    public function actionUnsubscribe()
    {
        return $this->render('unsubscribe');
        $request = Yii::$app->request;
        $hash = HtmlPurifier::process($request->get('hash'));

        if (($subscribe = SubscribeEmail::findOne(['hash' => $hash])) != null) {
            $subscribe->delete();

            return $this->render('unsubscribe');
        }

        throw new NotFoundHttpException();
    }

}
