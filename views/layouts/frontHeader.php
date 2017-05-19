<?php
use app\widgets\WLang;
$path = \Yii::$app->getRequest()->getPathInfo();
if(strlen($path) > 0 && $path[strlen($path)-1] == '/')
    $path = substr($path,0,strlen($path)-1);
$pathRoot = explode('/',$path)[0];
?>

<div class="header">
    <div class="header_second_menu">
        <div class="container-fluid">
            <div class="row header_second_menu_content">
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="row_content">
                        <div class="logo">
                            <a href="/">
                                <img class="img-responsive" src="/images/logo.png" alt="Главная">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-6 header_middle_box">
                    <div class="row_content">
                        <ul class="nav nav-pills main_menu">
                            <li><a href="/<?=\app\models\Lang::getCurrent()->url?>/encyclopedia" class="<?php if($pathRoot == 'encyclopedia') echo 'active';?>"><?= Yii::t('app','Encyclopedia'); ?></a></li>
                            <li><a href="/<?=\app\models\Lang::getCurrent()->url?>/library" class="<?php if($pathRoot == 'library') echo 'active';?>"><?= Yii::t('app','Library'); ?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 header_right_box">
                    <div class="row_content">
                        <div class="search_link">
                            <a href="<?= Yii::$app->urlManager->createUrl('/search', array('lang_id'=>\app\models\Lang::getCurrent()->id)); ?>"><?= Yii::t('app','Search'); ?></a>
                        </div>
                        <div class="cabinet_link">
                            <a href="<?= Yii::$app->urlManager->createUrl('/user', array('lang_id'=>\app\models\Lang::getCurrent()->id)); ?>"><?= Yii::t('app','User cabinet'); ?></a>
                        </div>
                    </div>
                </div>
                <?= WLang::widget();?>
            </div>
        </div>
    </div>
</div>
