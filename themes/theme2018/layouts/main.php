<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\app\assets\AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Татар Иле<?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
	<meta name="description" content="Справочная и обучающая база для школьников, их родителей и учителей для изучения истории, культуры и природы Республики Татарстан">
    <?php $this->head() ?>
</head>
<body class="not-front">
<?php $this->beginBody() ?>
<div class="wrap">

    <div class="content_body">

        <?= $this->render('header'); ?>

        <?= $content ?>

    </div>
    <?= $this->render('footer'); ?>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
