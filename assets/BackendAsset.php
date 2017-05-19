<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 21.11.2016
 * Time: 10:53
 */

class BackendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/backend.css',
    ];
    public $js = [
        'js/backend.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}