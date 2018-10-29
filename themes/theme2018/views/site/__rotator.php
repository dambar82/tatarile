<div class="block--rotator">
    <div class="view--rotator">
        <div class="rotator-row slide">
            <img src="/images/slide1.jpg" alt="" />
        </div>
        <div class="rotator-row slide">
            <img src="/images/slide2.jpg" alt="" />
        </div>
        <div class="rotator-row slide">
            <img src="/images/slide3.jpg" alt="" />
        </div>
        <div class="rotator-row slide">
            <img src="/images/slide4.jpg" alt="" />
        </div>
    </div>
    <div class="block--content">
        <div class="container-fluid">
            <div class="block--text-main">
                <h1><small><?= Yii::t('app','ШКОЛЬНАЯ ЭЛЕКТРОННАЯ'); ?></small><?= Yii::t('app','Library'); ?></h1>
                <div class="text-main--info">
                    <p><?= Yii::t('app','Всё о татарском народе и Татарстане в его исторических границах.'); ?></p>
                </div>
            </div>
            <div class="block--main-search">
                <div class="block--content">
                    <form role="form" class="form--main-search" action="<?=$lang_url?>/search" method="GET">
                        <div class="form--input">
                            <input class="input--field" type="text" name="q" value="" placeholder="<?= Yii::t('app','Enter search term'); ?>">
                        </div>
                        <button type="submit" class="form--submit"><i class="glyphicon glyphicon-search"></i></button>
                    </form>

                    <?= \app\widgets\widgets2018\RandomTagWidget\RandomTagWidget::widget(['lang_url' => $lang_url])?>

                </div>
            </div>
        </div>
        <div class="block--lnks-article">
            <div class="container-fluid">
                <p>Читать адаптированные статьи по <a href="">истории</a>, <a href="">географии</a>, смотреть <a href="">мультфильмы</a></p>
            </div>
        </div>
    </div>
</div>