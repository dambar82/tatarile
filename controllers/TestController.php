<?php

namespace app\controllers;

use app\backend\models\EntityTags;
use app\models\Lang;
use app\modules\admin\models\ConfigSeo;
use app\modules\statistics\models\AdminActionStatistics;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;

class TestController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        $this->layout = "mainTest";
        return $this->render('index');
    }
}
