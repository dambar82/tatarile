<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\app\themes\theme2018\assets\Theme2018Asset::register($this);
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

    <?= $this->render('header'); ?>

    <?= $content ?>

    <?= $this->render('footer'); ?>
</div>
<div class="block--subscribed hidden">
    <a class="subscribed--close" href="javascript:;" onclick="$('.block--subscribed').addClass('hidden')">
        <img src="/images/subscribed-close.png" alt="" class="img-responsive">
    </a>
    <div class="subscribed--logo">
        <img src="/images/subscribed-logo.png" alt="" class="img-responsive">
    </div>
    <div class="subscribed--text">
        <span>Подписка оформлена</span>
    </div>
    <div class="subscribed--ok">
        <i class="glyphicon glyphicon-ok"></i>
    </div>
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
