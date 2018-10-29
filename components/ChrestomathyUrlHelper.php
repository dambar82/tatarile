<?php

namespace app\components;

use app\models\chrestomathy\ChrestomathyEntity;
use Yii;

/**
 * Universal helper for common use cases
 * @package app\components
 */
class ChrestomathyUrlHelper
{
    public static function createEntityUrl($id)
    {
        $pathInfo = Yii::$app->urlManager->createUrl('entity/product',array('lang_id'=>\app\models\Lang::getCurrent()->id));

        $pathInfo = preg_replace('~[^\w+\-/]+~','',$pathInfo);
        $url_stric = explode('/',$pathInfo);

        if (!isset($url_stric[2]) || !isset($url_stric[3])) {
            return '/error';
        }

        if (($model = ChrestomathyEntity::findOne($id)) !== NULL) {
            $result = 'http://chrestomathy.tatarile.tatar/'.$url_stric[1].'/info/'.$model->slug;
            return $result;
        }
        return '/error';
    }
}
