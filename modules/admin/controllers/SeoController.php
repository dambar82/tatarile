<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\ConfigSeo;
use Yii;
use yii\helpers\Url;

class SeoController extends \yii\web\Controller
{
    public function actionCreateRobots()
    {
        $model = new ConfigSeo();
        return $this->render('create-robots',[
            'model' => $model
        ]);
    }
    public function actionUpdateRobots()
    {
        if (($model = ConfigSeo::findOne(1)) == NULL) {
            $model = new ConfigSeo();
        }
        if ($model->load(Yii::$app->request->post()) & $model->save()) {
            return $this->redirect([Url::to('/admin')]);
        }
        return $this->render('update-robots',[
            'model' => $model
        ]);
    }

}
