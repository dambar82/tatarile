<?php

namespace app\components;

use app\modules\admin\models\Config;
use Yii;
use yii\helpers\ArrayHelper;


/**
 * Universal helper for common use cases
 * @package app\components
 */
class ConfigHelper
{
    public static function getConfigByName($name)
    {
        if (($title = Config::find()->select('value')->where(['title' => $name])->scalar()) == NULL) {$title = '';}
        return $title;
    }

    public static function getExtensionByName($name)
    {
        if (($title = Config::find()->select('value')->where(['title' => $name])->scalar()) == NULL) {$title_array = '';}
        $json = '[';
        if ($title !== NULL) {
            $title_array = explode(',', $title);
            foreach ($title_array as $t_a) {
                $json.='["'.$t_a.'"],';
            }
        }
        $json = substr($json, 0, -1);
        $json .= ']';

        return json_decode($json,true);
    }
}
