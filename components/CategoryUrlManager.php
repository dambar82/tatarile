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

class CategoryUrlManager extends Object implements UrlRuleInterface
{
    private $encroute = 'encyclopedia';

    public function createUrl($manager, $route, $params)
    {
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();

        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches)) {

            if ((empty($matches[0])) || (empty($matches[1]))) {
                return false;
            }

            $rout ='';

            if (($this->encroute == $matches[0]) & ($this->encroute == $matches[1])) {
                $rout = $this->encroute;
            }

			if (!empty($rout)) {
				return ['search/index', ['type' =>NULL]];
			}
        }

        return false;
    }

}