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
    <div class="block--dop-links" style="position: absolute; right: 50px; top:0;">
        <ul class="nav nav-pills dop-links">
            <li>
                <?php if (!Yii::$app->user->isGuest) : ?>
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" class="change_theme" data-theme="theme2017">Тема 2017</a></li>
                            <li><a href="javascript:void(0)" class="change_theme" data-theme="theme2018">Тема 2018</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</div>
<div class="header header-encyclop">
    <div class="container-fluid">
        <div class="content row">
            <div class="block--logo col-xs-12">
                <div class="logo">
                    <a href="<?= $lang_url ?>/">
                        <img class="img-responsive" src="/images/logo-18.png" alt="Главная">
                    </a>
                </div>
            </div>
            <div class="block--main-menu col-xs-12">
                <ul class="nav nav-pills main-menu">
                    <li <?= (isset(Yii::$app->params['activ'])) ? 'class="active"' : '' ?>>
                        <a href="<?=$lang_url ?>/encyclopedia?category_id=2"><small><?= Yii::t('app','ШКОЛЬНАЯ ЭЛЕКТРОННАЯ'); ?></small><?= Yii::t('app','Library'); ?></a>
                    </li>
                    <li>
                        <a href="http://chrestomathy.tatarile.tatar/info"><small>ӘДӘБИ УКУ БУЕНЧА ЭЛЕКТРОН</small>ХРЕСТОМАТИЯ</a>
                    </li>
                </ul>
            </div>
            <div class="block--auth col-xs-12">
                <div class="view--auth">
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <a href="/login" class="auth-lnk"><?= Yii::t('app','Login'); ?></a>
                        <a href="/register" class="registr-lnk"><?= Yii::t('app','Register'); ?></a>
                    <?php } else { ?>
                        <a href="/<?=\app\models\Lang::getCurrent()->url?>/user" class="cabinet-lnk"><?= Yii::t('app','Cabinet'); ?></a>
                        <a href="/<?=\app\models\Lang::getCurrent()->url?>/logout" class="logout-lnk"><?= Yii::t('app','Logout'); ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS
    $('.change_theme').click(function() {
      var theme = $(this).attr('data-theme');
      
      $.ajax({
        'data' : {'theme': theme},
        'dataType' : 'html',
        'success' : function(data) {
            window.location.reload();
        },
        'type' : 'post',
        'url' : '/theme/change'
      });
      
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>