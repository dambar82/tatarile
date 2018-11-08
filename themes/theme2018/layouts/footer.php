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
<div class="block--subscribed hidden">
    <a class="subscribed--close" href="javascript:;" onclick="$('.block--subscribed').addClass('hidden')">
        <img src="/images/subscribed-close.png" alt="" class="img-responsive">
    </a>
    <div class="subscribed--logo">
        <img src="/images/subscribed-logo.png" alt="" class="img-responsive">
    </div>
    <div class="subscribed--text">
        <span><?=Yii::t('app','Подписка оформлена')?></span>
    </div>
    <div class="subscribed--ok">
        <i class="glyphicon glyphicon-ok"></i>
    </div>
</div>

<div id="footer">
    <div class="inside_footer">
        <div class="container-fluid">
            <div class="row footer_content">
                <div class="col-xs-6 col-sm-6 col-md-4 footer_block first_footer">
                    <div class="logo">
                        <a href="/">
                            <img class="img-responsive" src="/images/logo.png" alt="Главная">
                        </a>
                    </div>
                    <div class="block--copy">
                        <p>© <?=Yii::t('app','Татар Иле')?>
                            <?= date("Y") ?>.</p>
                        <p><?=Yii::t('app','All rights reserved')?></p>
                        <p><small>
                                <?=Yii::t('app','Татарское детское издательство')?><br>
                                info@tdpress.ru,
                                (843) 518 34 07<br></small>
                        </p>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-4 col-md-push-4 footer_block third_footer">
                    <ul class="bottom_menu">
                        <li><a href="<?=\yii\helpers\Url::to('http://tatarile.tatar')?>"><?= Yii::t('app','Library'); ?></a></li>
                        <li><a href="<?=\yii\helpers\Url::to('http://chrestomathy.tatarile.tatar')?>"><?= Yii::t('app','Chrestomathy'); ?></a></li>
                        <li><a href="<?=$lang_url.\yii\helpers\Url::to('/site/about')?>"><?= Yii::t('app','About'); ?></a></li>
                        <li><a href="<?=$lang_url.\yii\helpers\Url::to('/site/contact')?>"><?= Yii::t('app','Contacts'); ?></a></li>
                        <div style="margin-top: 5px;">
                            <!--LiveInternet logo--><a href="//www.liveinternet.ru/click"
                            target="_blank"><img src="//counter.yadro.ru/logo?44.6"
                                                                    title="LiveInternet"
                                                                    alt="" border="0" width="31" height="31"/></a><!--/LiveInternet-->
                        </div>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-md-pull-4 footer_block second_footer">
                    <?= \app\widgets\widgets2018\SubscribeWidget\SubscribeWidget::widget([]) ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter45422304 = new Ya.Metrika({
                        id:45422304,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/45422304" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-103177722-1', 'auto');
        ga('send', 'pageview');

    </script>
</div>
