<?php
use yii\helpers\Url;
?>

<div class="main_block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1 col-lg-3 do-not-print">
                <div class="btn_prev_page">
                    <a class="btn" href="<?=Url::to(Yii::$app->request->referrer)?>"><?=Yii::t('app','back')?></a>
                </div>
            </div>
            <div class="col-md-10 col-lg-6">
                <h1 class="title" id="page-title"><?= Yii::t('app', 'Рассылка')?></h1>
            </div>
        </div>
    </div>
</div>

<div class="basic-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-lg-6 col-md-push-1 col-lg-push-3">
                <div class="basic-page--content site-about">
                    <p style="font-size: 20px;">
                        <strong>
                            <?=Yii::t('app','Вы успешно отписались от рассылки TATARILE.tatar')?>
                        </strong>
                    </p>
                    <p style="font-size: 12px;">
                        <?=Yii::t('app','Вы успешно отписались от наших рассылок и на ваш email больше не будут поступать наши сообщения')?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCss("
    .main_block .btn_prev_page a {
            top: 25px;
    }
");