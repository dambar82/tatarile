<?php

namespace app\controllers;

use yii\web\Controller;

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
