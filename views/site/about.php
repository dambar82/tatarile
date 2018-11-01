<?php
use yii\helpers\Html;

$this->title = Yii::t('app','About the project title');
?>
<div class="main_block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-lg-6 col-md-push-1 col-lg-push-3">
                <div class="entity_subject">
                    <span><?=Yii::t('app','About')?></span>
                </div>
                <h1 class="title" id="page-title"><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="basic-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-lg-6 col-md-push-1 col-lg-push-3">
                <div class="basic-page--content site-about">
                    <p><strong><?=Yii::t('app','School electronic library')?> </strong><?=Yii::t('app','About the project footer')?>
                    </p>
                    <p><?=Yii::t('app','School electronic library')?> <?=Yii::t('app','About the project footer2')?>
                    </p>
                    <?=Yii::t('app','About the project')?>
                    <p class="text-center"><strong><?=Yii::t('app','Partners')?></strong></p>
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
