<?php
$entity_type = 1;
if ($type == 'library') {
    $entity_type = 0;
}
if (empty($type)) {$type = 'all';}
$entity_today = \app\backend\models\EntityCalendar::getTodayEntity($entity_type); //статья дня

$entitiesPop = $entitiesPop->all();

?>

        <?php if ($entity_today) :?>
            <div class="dop_widget day_stuff sidebar_row">
                <div class="sidebar_row_title">
                    <span><?= Yii::t('app','Article of the day'); ?></span>
                </div>
                <div class="sidebar_row_content">
                    <div class="stuff_img">
                        <a href="<?=\app\components\UrlHelper::createEntityUrl($entity_today['entity_id'])?>">
                            <?= \app\modules\file\widgets\Thumbnail::widget(['id' => $entity_today['entity_id']])?>
                        </a>
                    </div>
                    <div class="stuff_link">
                        <a href="<?=\app\components\UrlHelper::createEntityUrl($entity_today['entity_id'])?>"><?=$entity_today['title']?></a>
                    </div>
                </div>
            </div>
        <?php endif;?>
        <div class="dop_widget sidebar_row random_article">
            <div class="sidebar_row_title">
                <span><?= Yii::t('app','Articles generator'); ?></span>
            </div>
            <div class="sidebar_row_content">
                <div class="widget_content">
                    <a href="/entity/random-entry?type=<?= $type; ?>" class="btn random_article_btn"><?= Yii::t('app','Show'); ?>!</a>
                </div>
            </div>
        </div>
        <?php
        if(!empty($entitiesPop)) {
            ?>
            <div class="dop_widget interesting_stuff sidebar_row">
                <div class="sidebar_row_title">
                    <span><?= Yii::t('app','It is interesting'); ?></span>
                </div>
                <div class="sidebar_row_content">
                    <?php
                    foreach ($entitiesPop as $entityPop) {
                        $entityPop->setEav();
                        $ep_title = \app\components\GetEntity::getEntityTitle($entityPop->id);
                        ?>
                        <div class="interesting_link">
                            <a href="<?=\app\components\UrlHelper::createEntityUrl($entityPop->id)?>"><?=$ep_title?></a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="dop_widget sidebar_row link_other_proj">
            <div class="sidebar_row_content">
                <div class="widget_content">
                    <a href="http://ganiev.org/" target="_blank"><img class="img-responsive" src="<?= Yii::getAlias('@web/images/').'img-ganiev_wo.png'; ?>" alt=""></a>
                </div>
            </div>
        </div>
        <div class="dop_widget sidebar_row link_other_proj">
            <div class="sidebar_row_content">
                <div class="widget_content">
                    <a href="http://ebook.tatar/" target="_blank"><img class="img-responsive" src="<?= Yii::getAlias('@web/images/').'img-ebook_wo.png'; ?>" alt=""></a>
                </div>
            </div>
        </div>
