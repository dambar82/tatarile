<?php
/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 14.11.2016
 * Time: 13:11
 */
namespace app\components;

use yii\web\UrlRuleInterface;
use yii\base\Object;

class EntityEncUrlManager extends Object implements UrlRuleInterface
{
    private $enc_route = 'encyclopedia';

    public function createUrl($manager, $route, $params)
    {
        if ($route === $this->enc_route . '/product') {
            if (isset($params['slug'])) {
                return $params['slug'];
            }
        }
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches)) {
            if ((empty($matches[1])) || (empty($matches[3]))) {
                return false;
            }
			if (($model = \app\backend\models\Entity::findOne(['slug' => $matches[3],'status' => 1])) !== NULL) {

				if ($this->enc_route != $matches[1]) {
                    return false;
                }
				return ['entity/product', ['id' => $model['id']]];
			}
        }

        return $this->parseEnc($pathInfo);
    }

    protected function parseEnc($pathInfo)
    {
        $pathInfo = preg_replace('~[^\w+\-/]+~','',$pathInfo);
        $pathInfo = explode('/',$pathInfo);

        if ((empty($pathInfo[0])) || ($pathInfo[0] != $this->enc_route)) {
            return false;
        }
        if (empty($pathInfo[1])) {
            return false;
        }

        if (($model = \app\backend\models\Entity::findOne(['slug' => $pathInfo[1],'status' => 1])) !== NULL) {
            return ['entity/product', ['id' => $model['id']]];
        }
        return false;
    }
}