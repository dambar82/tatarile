<div id="footer">
    <div class="inside_footer">
        <div class="container-fluid">
            <div class="row footer_content">
                <div class="">
                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 footer_block first_footer">
                        <div class="logo">
                            <a href="/">
                                <img class="img-responsive" src="/images/logo.png" alt="Главная">
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 col-md-push-6 col-lg-push-6 footer_block third_footer">
                        <ul class="bottom_menu">
                            <li><a href="<?=\yii\helpers\Url::to('/site/about')?>"><?= Yii::t('app','About'); ?></a></li>
                            <li><a href="<?=\yii\helpers\Url::to('/site/contact')?>"><?= Yii::t('app','Contacts'); ?></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-pull-3 col-lg-pull-3 footer_block second_footer">
                        <p>© <?=Yii::t('app','Project')?> 2016. <?=Yii::t('app','All rights reserved')?></p>
                        <p><small>
                            <?=Yii::t('app','Tatarmultfilm')?><br>
                            info@tdpress.ru,
                            (843) 518 34 07<br></small>
                        </p>
                        <!--LiveInternet logo--><a href="//www.liveinternet.ru/click"
                                                   target="_blank"><img src="//counter.yadro.ru/logo?44.6"
                                                                        title="LiveInternet"
                                                                        alt="" border="0" width="31" height="31"/></a><!--/LiveInternet-->
                    </div>
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
