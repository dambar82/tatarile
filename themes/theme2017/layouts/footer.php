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
                        <p>© <?=Yii::t('app','Project')?>  <?= date("Y") ?>. <?=Yii::t('app','All rights reserved')?></p>
                        <p><small>
                                <?=Yii::t('app','Tatarmultfilm')?><br>
                                info@tdpress.ru,
                                (843) 518 34 07<br></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
