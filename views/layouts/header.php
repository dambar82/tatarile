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

<div class="header">
    <div class="header_first_menu">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-9 col-lg-9 col-lg-push top-menu-block">
                    <ul class="nav nav-pills top_menu">
                        <li><a href="<?=$lang_url.\yii\helpers\Url::to('/site/about')?>"><?= Yii::t('app','About'); ?></a></li>
                        <li><a href="<?=$lang_url.\yii\helpers\Url::to('/site/contact')?>"><?= Yii::t('app','Contacts'); ?></a></li>
                    </ul>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3 lang_box">
                    <?= WLang::widget();?>
                </div>
            </div>
        </div>
    </div>
    <div class="header_second_menu">
        <div class="container-fluid">
            <div class="row header_second_menu_content">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 header_left_box">
                    <div class="row_content">
                        <div class="inside-row_content">
                            <div class="logo">
                                <?php
                                $cur_lang = \app\models\Lang::getCurrent();
                                ?>
                                <a href="/<?php if($cur_lang->id != 2) echo $cur_lang->url.'/';?>">
                                    <img class="img-responsive" src="/images/logo.png" alt="Главная">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 col-md-push-6 col-lg-push-6 header_right_box">
                    <div class="row_content">
                        <div class="inside-row_content">
                            <?php if (Yii::$app->user->isGuest) { ?>
                                <a href="/login" class="authoriz_lnk"><?= Yii::t('app','Login'); ?></a>
                                <a href="/register" class="register_lnk"><?= Yii::t('app','Register'); ?></a>
                                <?php } else { ?>
                                    <a href="/<?=\app\models\Lang::getCurrent()->url?>/user" class="cabinet_lnk"><?= Yii::t('app','Cabinet'); ?></a>
                                    <a href="/<?=\app\models\Lang::getCurrent()->url?>/logout" class="logout_lnk"><?= Yii::t('app','Logout'); ?></a>
                                <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-6 col-md-pull-3 col-lg-pull-3 header_middle_box">
                    <div class="row_content">
                        <div class="inside-row_content">
                            <ul class="nav nav-pills main_menu">
                                <li class="<?php if($pathRoot == 'encyclopedia') echo 'active';?>">
                                    <a href="/<?=\app\models\Lang::getCurrent()->url?>/encyclopedia?category_id=2"><small>ШКОЛЬНАЯ ЭЛЕКТРОННАЯ</small><?= Yii::t('app','Library'); ?></a>
                                </li>
                                <li>
                                    <a href=""><small>ӘДӘБИ УКУ БУЕНЧА ЭЛЕКТРОН</small>ХРЕСТОМАТИЯ</a>
                                </li>
                            </ul>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
