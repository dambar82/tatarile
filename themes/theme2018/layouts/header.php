<?php
use app\widgets\WLang;

$path = \Yii::$app->getRequest()->getPathInfo();
if(strlen($path) > 0 && $path[strlen($path)-1] == '/')
    $path = substr($path,0,strlen($path)-1);
$pathRoot = explode('/',$path)[0];
$lang = \app\models\Lang::getCurrent();
$lang_url = "";
if($lang->id != 2) {
    $lang_url = '/'.$lang->url;
}
?>


<div class="pre-header">
    <div class="container-fluid">
        <div class="content clearfix">

            <?= \app\widgets\widgets2018\LanguageWidget\LanguageWidget::widget() ?>

            <div class="block--dop-links">
                <ul class="nav nav-pills dop-links">
                    <li>
                        <a href="<?=$lang_url.\yii\helpers\Url::to('/site/about')?>"><?= Yii::t('app','About'); ?></a>
                    </li>
                    <li>
                        <a href="<?=$lang_url.\yii\helpers\Url::to('/site/contact')?>"><?= Yii::t('app','Contacts'); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="header header-encyclop">
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