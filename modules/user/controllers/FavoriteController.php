<?php

namespace app\modules\user\controllers;

use app\modules\user\models\UserFavorite;
use Yii;
use yii\web\NotFoundHttpException;

class FavoriteController extends \yii\web\Controller
{
    public function actionAdd()
    {
      if (Yii::$app->request->isAjax) {
          Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
          $entity_id = Yii::$app->request->post('id');

          $user = \webvimark\modules\UserManagement\models\User::getCurrentUser();

          if ($user == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
          }

          if (($favotite_model = $this->findModel($user->id, $entity_id)) == NULL) {
                $favotite_model = new UserFavorite();
                $favotite_model->user_id = $user->id;
                $favotite_model->entity_id = $entity_id;
                $favotite_model->save();
          } else {
                $favotite_model->delete();
          }
          return true;
      }
      else {
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }


    protected function findModel($id,$entity_id)
    {
        if (($model = UserFavorite::findOne(['user_id' => $id, 'entity_id' => $entity_id])) !== null) {
            return $model;
        } else {
            return NULL;
        }
    }

}
