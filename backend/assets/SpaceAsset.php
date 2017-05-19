<?php

namespace app\backend\assets;

use yii\web\AssetBundle;

/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 21.11.2016
 * Time: 10:53
 */

class SpaceAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/imperavi/space.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}