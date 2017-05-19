<?php

namespace app\modules\user\controllers;

use Yii;
use app\modules\user\models\UserInfo;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\modules\user\models\UserFavorite;


class CabinetController extends \yii\web\Controller
{


    public function actionIndex()
    {
        $model = \webvimark\modules\UserManagement\models\User::getCurrentUser();

        if ($model == NULL) {
            return $this->redirect(Url::to('/register'));
        }
        if (!isset($model->id)) {
            return $this->redirect(Url::to('/register'));
        }
        if ($this->findUserModel($model->id) == null) {
            return $this->redirect(Url::to('/register'));
        }

        $favorite = UserFavorite::find()->where(['user_id' => $model->id])->all();
        $favorite = \app\components\GetEntity::getFavorite($favorite);

        $user_info = $this->findModel($model->id);

        return $this->render('index', [
            'user_info' => $user_info,
            'account' => $model,
            'favorite' => $favorite,
        ]);
    }

    public function actionUpdate()
    {
        $model = \webvimark\modules\UserManagement\models\User::getCurrentUser();
        if ($this->findUserModel($model->id) == null) {
          throw new NotFoundHttpException('The requested page does not exist.');
        }

        $user_info = $this->findModel($model->id);
        $user_info->user_id = $model->id;

        if ($user_info->load(Yii::$app->request->post())) {
            $img_file = UploadedFile::getInstance($user_info,"file_name");
            if (!empty($img_file)) {
                $filename = md5($img_file->baseName. date("YmdHms")) .'.'. $img_file->extension;
                $img_file-> saveAs(Yii::getAlias('@web').'files/avatars/'.$filename);
                $user_info->file_name = $filename;
            }
            $user_info->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $user_info,
            ]);
        }
    }

    protected function findUserModel($id)
    {

        if (($model = \webvimark\modules\UserManagement\models\User::findOne($id)) !== null) {
            return $model;
        } else {
            $this->redirect(Url::to('/register'));
        }
        return $this->redirect(Url::to('/register'));
    }
    protected function findModel($id)
    {
        if (($model = UserInfo::findOne(['user_id' => $id])) !== null) {
            return $model;
        } else {
            return new UserInfo();
        }
    }

}
