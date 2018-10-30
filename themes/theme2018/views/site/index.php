<?php

use app\widgets\widgets2018\PopularChrestomathyWidget\PopularChrestomathyWidget;
use app\widgets\widgets2018\PopularArticlesWidget\PopularArticlesWidget;

/* @var $this \yii\web\View */
/* @var $lang_url string */

$lang = \app\models\Lang::getCurrent();
$lang_url = "";
if($lang->id != 2) {
    $lang_url = '/'.$lang->url;
}
?>

<?= $this->render('__rotator', [
    'lang_url' => $lang_url
]) ?>

<?= PopularArticlesWidget::widget() ?>

<div class="section section--chrestom">
    <div class="container-fluid">
        <div class="block--see-chrestom">
            <div class="chrestom--text">
                <div class="chrestom--title">
                    <small>ӘДӘБИ УКУ БУЕНЧА ЭЛЕКТОН</small>ХРЕСТОМАТИЯ
                </div>
                <div class="chrestom--descr">
                    <p><?= Yii::t('app','Для начальных классов общеобразовательных школ с обучением на татарском языке'); ?></p>
                </div>
            </div>
            <div class="chrestom--classes">
                <div class="row">
                    <?php foreach ([0,1,2,3] as $key => $value): ?>
                        <div class="col-xs-3">
                            <div class="classes--cont">
                                <div class="classes--num">
                                    <span><?= $key + 1 ?></span>
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
                <a href="http://chrestomathy.tatarile.tatar" class="chrestom--enter"><?= Yii::t('app','ВОЙТИ'); ?></a>
            </div>
        </div>
    </div>
</div>

<?= PopularChrestomathyWidget::widget() ?>

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