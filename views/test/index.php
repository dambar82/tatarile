<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\app\themes\theme2018\assets\Theme2018Asset::register($this);

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
