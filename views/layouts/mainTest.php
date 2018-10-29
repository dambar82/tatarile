<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\TestAsset;

TestAsset::register($this);

$lang_url = "";
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="front">
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="pre-header">
        <div class="container-fluid">
            <div class="content clearfix">
                <div class="block--lang">
                    <ul class="nav nav-pills lang-menu">
                        <li class="menu--item">
                            <a href="/tt/">Тат</a>        
                        </li>
                        <li class="menu--item">
                            <span>Рус</span>        
                        </li>
                        <li class="menu--item">
                            <a href="/en/">Eng</a>       
                        </li>
                    </ul>
                </div>
                <div class="block--dop-links">
                    <ul class="nav nav-pills dop-links">
                        <li>
                            <a href="/site/about"><?= Yii::t('app','About'); ?></a>
                        </li>
                        <li>
                            <a href="/site/contact"><?= Yii::t('app','Contacts'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="container-fluid">
            <div class="content row">
                <div class="block--logo col-xs-12">
                    <div class="logo">
                        <a href="/">
                            <img class="img-responsive" src="/images/logo-18.png" alt="Главная">
                        </a>
                    </div>
                </div>
                <div class="block--main-menu col-xs-12">
                    <ul class="nav nav-pills main-menu">
                        <li>
                            <a href="/encyclopedia?category_id=2"><small><?= Yii::t('app','ШКОЛЬНАЯ ЭЛЕКТРОННАЯ'); ?></small><?= Yii::t('app','Library'); ?></a>
                        </li>
                        <li>
                            <a href="http://chrestomathy.tatarile.tatar/info"><small>ӘДӘБИ УКУ БУЕНЧА ЭЛЕКТРОН</small>ХРЕСТОМАТИЯ</a>
                        </li>
                    </ul> 
                </div>
            </div>
        </div>
    </div>
    <div class="block--rotator">
        <div class="view--rotator">
            <div class="rotator-row slide">
                <img src="/images/slide1.jpg" alt="" />
            </div>
            <div class="rotator-row slide">
                <img src="/images/slide2.jpg" alt="" />
            </div>
            <div class="rotator-row slide">
                <img src="/images/slide3.jpg" alt="" />
            </div>
            <div class="rotator-row slide">
                <img src="/images/slide4.jpg" alt="" />
            </div>
        </div>
        <div class="block--content">
            <div class="container-fluid">
                <div class="block--text-main">
                    <h1><small><?= Yii::t('app','ШКОЛЬНАЯ ЭЛЕКТРОННАЯ'); ?></small><?= Yii::t('app','Library'); ?></h1>
                    <div class="text-main--info">
                        <p>Всё о татарском народе и Татарстане в его исторических границах.</p>
                    </div>
                </div>
                <div class="block--main-search">
                    <div class="block--content">
                        <form role="form" class="form--main-search" action="<?=$lang_url?>/search" method="GET">
                            <div class="form--input">
                                <input class="input--field" type="text" name="q" value="" placeholder="<?= Yii::t('app','Enter search term'); ?>">
                            </div>
                            <button type="submit" class="form--submit"><i class="glyphicon glyphicon-search"></i></button>
                        </form>
                        <div class="hash-tag">
                            <div class="hash-tag--label">
                                <span><?= Yii::t('app','or use hashtags');?></span>
                            </div>
                            <div class="hash-tag--content">
                                <div class="hash-tag--links">
                                    <a href="" class="random-tag">#демография</a>
                                    <a href="" class="random-tag">#демография</a>
                                </div>
                            </div>
                            <button class="hash-tag--update"><i class="glyphicon glyphicon-refresh"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block--lnks-article">
                <div class="container-fluid">
                    <p>Читать адаптированные статьи по <a href="">истории</a>, <a href="">географии</a>, смотреть <a href="">мультфильмы</a></p>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="section">
        <div class="container-fluid">
            <div class="view--entity">
                <h2>ПОПУЛЯРНЫЕ СТАТЬИ</h2>
                <div class="view--content row">
                    <div class="col-xs-4 col-sm-4 col-md-4 view--row">
                        <div class="row--content">
                            <div class="content--wrap">
                                <div class="entity--type">
                                    <span class="type-1"></span>
                                </div>
                                <div class="entity--img">
                                    <a href="/ru/encyclopedia/bronzovy-vek">
                                        <img class="img-responsive" src="/images/default/1.png" alt="">
                                    </a>
                                </div>
                                <div class="entity--title">
                                    <a href="/ru/encyclopedia/bronzovy-vek">БРОНЗОВЫЙ ВЕК</a>
                                </div>
                                <div class="entity--razdel">
                                    <span>История</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="entity--see-all text-center">
                    <a href="">Смотреть все статьи</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="section section--chrestom">
        <div class="container-fluid">
            <div class="block--see-chrestom">
                <div class="chrestom--text">
                    <div class="chrestom--title">
                        <small>ӘДӘБИ УКУ БУЕНЧА ЭЛЕКТОН</small>ХРЕСТОМАТИЯ
                    </div>
                    <div class="chrestom--descr">
                        <p>Для начальных классов общеобразовательных школ с обучением на татарском языке</p>
                    </div>
                </div>
                <div class="chrestom--classes">
                    <div class="row">
                        <?php foreach ([0,1,2,3] as $key => $value): ?>
                        <div class="col-xs-3">
                            <div class="classes--cont">
                                <div class="classes--num">
                                    <span>1</span>
                                </div>
                                <div class="classes--title">
                                    <span>сыйныф</span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="text-center">
                    <a href="" class="chrestom--enter">ВОЙТИ</a>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="section">
        <div class="container-fluid">
            <div class="view--entity">
                <h2>ПОПУЛЯРНЫЕ ПРОИЗВЕДЕНИЯ</h2>
                <div class="view--content row">
                    <div class="col-xs-4 col-sm-4 col-md-4 view--row">
                        <div class="row--content">
                            <div class="content--wrap">
                                <div class="entity--type">
                                    <span class="type-1"></span>
                                </div>
                                <div class="entity--img">
                                    <a href="/ru/encyclopedia/bronzovy-vek">
                                        <img class="img-responsive" src="/images/default/1.png" alt="">
                                    </a>
                                </div>
                                <div class="entity--title">
                                    <a href="/ru/encyclopedia/bronzovy-vek">БРОНЗОВЫЙ ВЕК</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="entity--text-footer">
                    <p>Мультимедийная библиотека содержит аудио, видео материалы, книги и периодические издания, относящиеся к историко-культурному наследию Татарстана и татарского народа.</p>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="section">
        <div class="container-fluid">
            <div class="view--partners">
                <div class="text-center">
                    <h2 class="view--title"><?=Yii::t('app','Partners')?></h2>
                </div>
                <ul class="partnesr--list">
                    <?php
                    $partners_list = Yii::t('app','Partners list');
                    foreach ($partners_list as $partner_el) {
                        echo '<li>'.$partner_el.'</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="about_company">
        <div class="container-fluid">
            <div class="view--about-company">
                <h2><?=Yii::t('app','School electronic library')?></h2>
                <div class="about-company--content">
                    <p><?=Yii::t('app','Footer description of the site')?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="block_subscribe">
        <div class="container-fluid">
            <div class="row">
                <form role="form" class="form_subscribe">
                    <div>
                        <div class="form-item webform-logo">
                            <img class="img-responsive" src="<?= Yii::getAlias('@web/images/').'subscribe_img.png' ?>" alt="">
                        </div>
                        <div class="form-item webform-component-textfield">
                            <input type="text" name="subscribe" value="" placeholder="E-mail">
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn"><?= Yii::t('app','Subscribe'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= $this->render('footer'); ?>
</div>
<?php
$script = <<< JS
    $('.view--rotator').responsiveSlides({
        auto: true,
        speed: 500,
        timeout: 8000,
        pager: false,
        nav: false,
        random: true,
        pause: false,
        pauseControls: true,
        prevText: "Previous",
        nextText: "Next",
        maxwidth: "",
        navContainer: "",
        manualControls: "",
        namespace: "rslides",
        before: function(){},
        after: function(){}
    });


JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_END);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
