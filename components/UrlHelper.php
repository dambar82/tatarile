<?php

namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Universal helper for common use cases
 * @package app\components
 */
class UrlHelper
{
    public static function createEntityUrl($id)
    {
        $pathInfo = Yii::$app->urlManager->createUrl('entity/product',array('lang_id'=>\app\models\Lang::getCurrent()->id));

        $pathInfo = preg_replace('~[^\w+\-/]+~','',$pathInfo);
        $url_stric = explode('/',$pathInfo);

        if (!isset($url_stric[2]) || !isset($url_stric[3])) {
            return '/error';
        }

        if (($model = \app\backend\models\Entity::findOne($id)) !== NULL) {
            $result = '/'.$url_stric[1].'/encyclopedia/'.$model->slug;
            return $result;
        }
        return '/error';
    }
}
