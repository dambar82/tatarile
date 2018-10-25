<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\MainpageAsset;

AppAsset::register($this);
MainpageAsset::register($this);
$lang = \app\models\Lang::getCurrent();
$lang_url = "";
if($lang->id != 2) {
    $lang_url = '/'.$lang->url;
}
$randomHashTags = [];
for($i = 0; $i<3; $i++) {
    $notTag = "";
    if(count($randomHashTags) > 0) {
        foreach ($randomHashTags as $randomHashTagN) {
            if(strlen($notTag) > 0)
                $notTag .=" AND ";
            $notTag .= "`tag` <>'".$randomHashTagN->tag."'";
        }
    }
    $randomHashTag = \app\backend\models\EntityTags::find()
        ->where(['lang_id' => \app\models\Lang::getCurrent()->id])
        ->andWhere($notTag)
        ->offset(0)->limit(1)
        ->orderBy(new \yii\db\Expression('rand()'))
        ->all();
    if(count($randomHashTag) > 0)
        $randomHashTags[] = $randomHashTag[0];
}
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
<!--LiveInternet counter--><script type="text/javascript">
    new Image().src = "//counter.yadro.ru/hit?r"+
    escape(document.referrer)+((typeof(screen)=="undefined")?"":
    ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
    screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
    ";h"+escape(document.title.substring(0,80))+
    ";"+Math.random();</script><!--/LiveInternet-->
<div class="wrap">
    <?= $this->render('header'); ?>


    <div id="rotator">
        <div class="rotator_content">
            <div id="slider">
                <div class="rotator_row">
                    <div class="row_content">
                        <img src="/images/slide1.jpg" alt="" />
                    </div>
                </div>
                    <div class="rotator_row">
                        <div class="row_content">
                            <img src="/images/slide2.jpg" alt="" />
                        </div>
                    </div>
                        <div class="rotator_row">
                            <div class="row_content">
                                <img src="/images/slide3.jpg" alt="" />
                            </div>
                        </div>
                            <div class="rotator_row">
                                <div class="row_content">
                                    <img src="/images/slide4.jpg" alt="" />
                                </div>
                            </div>
            </div>
        </div>
    </div>
    <div class="block_main_search">
        <div class="container-fluid">
            <div class="row">
                <div class="block_main_search_content">
                    <form role="form" class="form_main_search" action="<?=$lang_url?>/search" method="GET">
                        <div class="form-group">
                            <input type="text" name="q" value="" placeholder="<?= Yii::t('app','Enter search term'); ?>">
                            <div class="inp_border"></div>
                        </div>
                        <button type="submit" class="btn"></button>
                    </form>
                    <?php
                    if(!empty($randomHashTags)) {
                        ?>
                        <div class="dynamic_hash_tag">
                            <div class="dynamic_hash_tag_content">
                                <div class="dynamic_hash_tag_span">
                                    <span><?= Yii::t('app','or use hashtags');?></span>
                                </div>
                                <div class="dynamic_hash_tag_wrap">
                                    <div class="dynamic_hash_tag_cont">
                                        <?=$this->render('@app/views/search/random-tagslist',[
                                            'randomHashTags' => $randomHashTags,
                                            'lang_url' => $lang_url
                                        ])?>
                                    </div>
                                    <button class="update-tags-btn"></button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>




    <div class="content_body">
        <div class="entry_point">
            <div class="view_row entry_encyclopedia">
                <div class="view_row_content">
                    <div class="container-fluid">
                        <div class="row">
                            <ul id="scene">
                                <li class="layer" data-depth="0.05"><img src="/images/entry/b6.png" style="width: 73%;"></li>
                                <li class="layer" data-depth="0.2"><img src="/images/entry/b1.png" style="top: 20%; left: 62%; position: absolute; width: 22%;"></li>
                                <li class="layer" data-depth="0.2"><img src="/images/entry/b2.png" style="top: 20%; left: 21%; position: absolute; width: 19%;"></li>
                                <li class="layer" data-depth="0.15"><img src="/images/entry/b3.png" style="bottom: 8%; left: 53%; position: absolute; width: 13%;"></li>
                                <li class="layer" data-depth="0.15"><img src="/images/entry/b4.png" style="bottom: 0%; left: 33%; position: absolute; width: 15%;"></li>
                                <li class="layer" data-depth="0.1"><div class="fly_word fly_word_1">a</div></li>
                                <li class="layer" data-depth="0"><div class="fly_word fly_word_2">B</div></li>
                                <li class="layer" data-depth="0.2"><div class="fly_word fly_word_3">c</div></li>
                                <li class="layer" data-depth="0.15"><div class="fly_word fly_word_4">e</div></li>
                                <li class="layer" data-depth="0.11"><div class="fly_word fly_word_5">o</div></li>
                                <li class="layer" data-depth="0.18"><div class="fly_word fly_word_6">p</div></li>
                                <li class="layer" data-depth="0.08"><div class="fly_word fly_word_7">x</div></li>
                                <li class="layer" data-depth="0.05"><div class="fly_word fly_word_8">M</div></li>
                                <li class="layer" data-depth="0.06"><div class="fly_word fly_word_9">h</div></li>
                                <li class="layer" data-depth="0.10"><img src="/images/entry/b5.png" style="position: absolute; left: 0; right: 0; bottom: -1%; margin: 0 auto; width: 48%;"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="entry_point_footer">
                    <div class="container-fluid">
                        <div class="entry_text">
                            <div class="entry_text_content">
                                <p><?=Yii::t('app','Description of the encyclopedia')?></p>
                                <a class="btn btn-default" href="http://tatarile.tatar/encyclopedia?category_id=2"><?=Yii::t('app', 'Encyclopedia')?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="view_row entry_library">
                <div class="view_row_content">
                    <div class="container-fluid">
                        <div class="row">
                            <ul id="scene_1">
                                <li class="layer" data-depth="0.10"><img src="/images/entry/i16.png" style="width: 73%;"></li>
                                <li class="layer" data-depth="1"><img src="/images/entry/i1.png" class="swing swing_1" style="top: 15%; left: 5%; width: 100px;"></li>
                                <li class="layer" data-depth="0.6"><img src="/images/entry/i2.png" class="swing swing_2" style="top: 43%; left: 5%; width: 100px;"></li>
                                <li class="layer" data-depth="0.4"><img src="/images/entry/i3.png" class="swing swing_3" style="top: 27%; left: 25%; width: 70px;"></li>
                                <li class="layer" data-depth="1"><img src="/images/entry/i4.png" class="swing swing_4" style="top: 15%; left: 45%; width: 85px;"></li>
                                <li class="layer" data-depth="1"><img src="/images/entry/i5.png" class="swing swing_5" style="top: 5%; left: 61%; width: 54px;"></li>
                                <li class="layer" data-depth="0.8"><img src="/images/entry/i6.png" class="swing swing_6" style="top: 22%; left: 70%; width: 85px;"></li>
                                <li class="layer" data-depth="0.2"><img src="/images/entry/i7.png" class="swing swing_7" style="top: 4%; left: 80%; width: 55px;"></li>
                                <li class="layer" data-depth="0.5"><img src="/images/entry/i8.png" class="swing swing_8" style="top: 43%; left: 84%; width: 70px;"></li>
                                <li class="layer" data-depth="0.7"><img src="/images/entry/i9.png" class="swing swing_9" style="top: 50%; left: 67%; width: 45px;"></li>
                                <li class="layer" data-depth="0.9"><img src="/images/entry/i10.png" class="swing swing_10" style="top: 60%; left: 77%; width: 65px;"></li>
                                <li class="layer" data-depth="0.1"><img src="/images/entry/i11.png" class="swing swing_11" style="top: 73%; left: 88%; width: 62px;"></li>
                                <li class="layer" data-depth="0.8"><img src="/images/entry/im1.png" class="swing swing_7" style="top: 26%; left: 15%; width: 23px;"></li>
                                <li class="layer" data-depth="0.6"><img src="/images/entry/im1.png" class="swing swing_2" style="top: 50%; left: 27%; width: 35px;"></li>
                                <li class="layer" data-depth="0.5"><img src="/images/entry/im2.png" class="swing swing_6" style="top: 29%; left: 0%; width: 35px;"></li>
                                <li class="layer" data-depth="0.3"><img src="/images/entry/im2.png" class="swing swing_4" style="top: 44%; left: 35%; width: 35px;"></li>
                                <li class="layer" data-depth="0.7"><img src="/images/entry/im3.png" class="swing swing_8" style="top: 51%; left: 13%; width: 35px;"></li>
                                <li class="layer" data-depth="1"><img src="/images/entry/im3.png" class="swing swing_9" style="top: 6%; left: 26%; width: 35px;"></li>
                                <li class="layer" data-depth="0.5"><img src="/images/entry/im4.png" class="swing swing_1" style="top: 57%; left: 4%; width: 35px;"></li>
                                <li class="layer" data-depth="0.4"><img src="/images/entry/im4.png" class="swing swing_2" style="top: 55%; left: 15%; width: 35px;"></li>
                                <li class="layer" data-depth="0.20"><img src="/images/entry/i12.png" style="bottom: 5%; left: 21%; position: absolute; width: 18.5%;"></li>
                                <li class="layer" data-depth="0.25"><img src="/images/entry/i13.png" style="bottom: 5%; left: 47%; position: absolute; width: 25%;"></li>
                                <li class="layer" data-depth="0.25"><img src="/images/entry/i15.png" style="bottom: 18%; left: 49%; position: absolute; width: 23%;"></li>
                                <li class="layer" data-depth="0.30"><img src="/images/entry/i14.png" style="bottom: 17%; left: 34%; position: absolute; width: 16%;"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="entry_point_footer">
                    <div class="container-fluid">
                        <div class="entry_text">
                            <div class="entry_text_content">
                                <p><?=Yii::t('app','Description of the library')?></p>
                                <a class="btn btn-default" href="http://chrestomathy.tatarile.tatar"><?=Yii::t('app', 'Chrestomathy')?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="partners">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-10 col-lg-6 col-md-push-1 col-lg-push-3">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="partners_content">
                                    <span class="partners_content-title"><?=Yii::t('app','Coordinator')?></span>
                                    <p><?=Yii::t('app','The Ministry of Education and Science of the Republic of Tatarstan')?></p>
                                </div>
                                <div class="partners_content">
                                    <span class="partners_content-title"><?=Yii::t('app','The main performer')?></span>
                                    <p><?=Yii::t('app','Tatarstan Education Development Institute')?></p>
                                </div>
                                <div class="partners_content">
                                    <span class="partners_content-title"><?=Yii::t('app','Accomplice')?></span>
                                    <p><?=Yii::t('app','ANO «Tatar Baby Publisher»')?></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="partners_content">
                                    <span class="partners_content-title"><?=Yii::t('app','Partners')?></span>
                                    <ul>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="about_company">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-push-1 col-md-push-2 col-lg-push-3">
                        <h2><?=Yii::t('app','School electronic library')?></h2>
                        <div class="about_company_content">
                            <p><?=Yii::t('app','Footer description of the site')?></p>
                        </div>
                    </div>
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
<?= $this->render('@app/views/site/iziForm'); ?>
<?php
$script = <<< JS
    $('#slider').slick({
        autoplay: true,
        autoplaySpeed: 4000,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear'
    });
    var scene = document.getElementById('scene');
    var parallax = new Parallax(scene);
    var scene_1 = document.getElementById('scene_1');
    var parallax_1 = new Parallax(scene_1);
    $(document).ready(function(e) {
        $('input[name="q"]').autocomplete({
            source:"$lang_url/search",
            minLength: 3
        });
        $('form.form_main_search').on('submit',function(e) {
            e.preventDefault();
            var obj = $(this);
            var ser = encodeURIComponent(obj.find('input[name="q"]').val().trim());
            if(ser.length > 0)
                window.location.href = obj.attr('action')+"?q="+ser;
        });
        var hTag = $('.block_main_search_content .dynamic_hash_tag');
        $('.block_main_search_content').focusin(function() {
            $(this).toggleClass('focus', true);
            if(hTag.length > 0)
                hTag.stop().animate({opacity: 1, height: hTag[0].scrollHeight}, 500);
        }).focusout(function() {
            $(this).toggleClass('focus', false);
            hTag.stop().animate({opacity: 0, height: "0"}, 500);
        });
    });

    /*   Responce rotator   */
    if ($(window).width() > 1920) {
        $("#rotator .row_content, #rotator .row_content img").width("100%");
        setTimeout(function() {
            $("#rotator .rotator_row").height($("#rotator .row_content img").height());
        }, 100);
    } else {
        $("#rotator .row_content, #rotator .row_content img").width("1920px");
        $("#rotator .rotator_row").height("448px");
    }
    $(window).resize(function() {
        if ($(window).width() > 1920) {
            $("#rotator .row_content, #rotator .row_content img").width("100%");
            $("#rotator .rotator_row").height($("#rotator .row_content img").height());
        } else {
            $("#rotator .row_content, #rotator .row_content img").width("1920px");
            $("#rotator .rotator_row").height("448px");
        }
    });



JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_END);
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
