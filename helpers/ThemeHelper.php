<?php

namespace app\helpers;

class ThemeHelper
{
    public static function defaultTheme()
    {
        if (($value = \Yii::$app->getRequest()->getCookies()->getValue('themeName')) == null) {
            return 'theme2018';
        }
        return $value;
    }
}