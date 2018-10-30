<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
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
<body class="not-front">
<?php $this->beginBody() ?>
<!--LiveInternet counter--><script type="text/javascript">
    new Image().src = "//counter.yadro.ru/hit?r"+
    escape(document.referrer)+((typeof(screen)=="undefined")?"":
    ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
    screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
    ";h"+escape(document.title.substring(0,80))+
    ";"+Math.random();</script><!--/LiveInternet-->
<div class="wrap">

    <div class="content_body">

        <?= $this->render('@app/themes/theme2018/layouts/header'); ?>

        <?= $content ?>

    </div>
    <?= $this->render('footer'); ?>
</div>
<?= $this->render('@app/views/site/iziForm'); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
