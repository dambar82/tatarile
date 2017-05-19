<?php

namespace app\backend\controllers;

use app\backend\helpers\TranslateHelper;
use app\backend\models\LangMap;
use app\models\Lang;
use Yii;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;


class TranslateController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $languages = Lang::find()->all();

        $mapping = ArrayHelper::map(LangMap::find()->all(),'value','id');

        $translates = TranslateHelper::getTranslate();

        return $this->render('index',[
            'model' => $translates,
            'languages' => $languages,
            'mapping' => $mapping
        ]);
    }

}
