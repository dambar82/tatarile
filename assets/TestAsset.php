<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TestAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/search.css',
        'css/slick-theme.css',
        'css/slick.css',
        'js/noUiSlider/nouislider.css',
        'css/jquery-ui-autocomplete.min.css',
        'css/site2018.css',
        'css/header.css',
        'css/footer.css'
    ];
    public $js = [
        'js/view.js',
        'js/responsiveslides.min.js',
        'js/jQuery.succinct.min.js',
        'js/jquery-ui-autocomplete.min.js',
        'js/scrolltopcontrol.js',
        'js/classie.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
