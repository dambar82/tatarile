<?php

namespace app\controllers;

use app\helpers\ThemeHelper;
use yii\base\Theme;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;

class ThemeController extends Controller
{

    public $defaultTheme = 'theme2018';

    public $themes = ['theme2017', 'theme2018'];

    public function init()
    {
        parent::init();
        $themeName = ThemeHelper::defaultTheme();
        if (!in_array($themeName, $this->themes)) {
            $themeName = $this->defaultTheme;
        }
        $this->setTheme($themeName);
    }

    public function actionChange()
    {
        $request = \Yii::$app->request;

        if ($request->isAjax) {
            $themeName = $request->post('theme');

            if (!in_array($themeName, $this->themes)) {
                $themeName = $this->defaultTheme;
            }

            $this->setTheme($themeName);
            return 'success';
        }

        throw new NotFoundHttpException();
    }

    protected function setTheme($themeName)
    {
        $cookie = new Cookie([
            'name' => 'themeName',
            'value' => $themeName,
            'expire' => time() + 86400 * 365
        ]);
        \Yii::$app->getResponse()->getCookies()->add($cookie);

        \Yii::$app->getView()->theme = new Theme([
            'pathMap' => [
                '@app/views' => '@app/themes/'.$themeName . '/views',
                '@app/views/search' => '@app/themes/'.$themeName . '/views/search',
            ],
        ]);
    }
}
