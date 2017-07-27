<?php

namespace app\modules\chrestomathy\controllers;

use app\backend\modules\reader\models\ChrestomathyThemes;
use yii\web\Controller;

/**
 * Default controller for the `chrestomathy` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $content = ChrestomathyThemes::find()->with('articles')->all();

        return $this->render('index', [
            'model' => $content
        ]);
    }
}
