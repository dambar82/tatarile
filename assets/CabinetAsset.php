<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 21.11.2016
 * Time: 10:53
 */

class CabinetAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/cabinet.css',
        'css/jquery.kladr.min.css',
    ];
    public $js = [
        'js/jquery.kladr.min.js',
        'js/cabinet.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}