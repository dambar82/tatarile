<?php

namespace app\modules\admin\controllers;

use app\backend\models\Entity;
use app\modules\admin\models\Config;
use app\modules\file\helpers\ResizeImage;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class ConfigController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $model = new Config();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect([Url::to('/admin')]);
        }
        return $this->render('create',['model'=>$model]);


    }

    public function actionUpdate($id)
    {
        if (($model = Config::findOne($id)) == NULL) {
            throw new NotFoundHttpException('The requested page does not exist. Not found config');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([Url::to('/admin')]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionThumbs()
    {
        $entities = Entity::find()->all();
        foreach ($entities as $entity) {
            if (!empty($entity->thumbnail)) {
                if (!file_exists(Yii::getAlias('@webroot/files/1150x900'))) {
                    mkdir(Yii::getAlias('@web').'files/1150x900');
                }
                if (!file_exists(Yii::getAlias('@webroot/files/1150x900/').$entity->thumbnail)) {
                    ResizeImage::resize($entity->thumbnail);
                }
            }
        }
    }

}
