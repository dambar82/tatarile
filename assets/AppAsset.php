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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/search.css',
        'css/slick-theme.css',
        'css/slick.css',
        'js/noUiSlider/nouislider.css',
        'css/jquery-ui-autocomplete.min.css',
        'css/iziModal.css',
        'js/colorbox/colorbox.css',
        'js/owlCarousel/owl.carousel.min.css',
        'js/owlCarousel/owl.theme.default.css',
        'css/site.css',
        'css/header.css',
        'css/footer.css'
    ];
    public $js = [
        'js/noUiSlider/nouislider.min.js',
        'js/view.js',
        'js/slick.min.js',
        'js/jQuery.succinct.min.js',
        'js/jquery-ui-autocomplete.min.js',
        'js/iziModal.js',
        'js/pluso.js',
        'js/scrolltopcontrol.js',
        'js/classie.js',
        'js/owlCarousel/owl.carousel.min.js',
        'js/site.js',
        'js/colorbox/jquery.colorbox-min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
