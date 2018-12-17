<?php

?>

<div class="entity-index">
    <?php
    if (!empty($content->filename)) {
        echo \wbraganca\videojs\VideoJsWidget::widget([
            'options' => [
                'class' => 'video-js vjs-default-skin vjs-big-play-centered',
                'poster' => "",
                'controls' => true,
                'preload' => 'auto',
                'width' => '900',
                'height' => '900',
            ],
            'tags' => [
                'source' => [
                    ['src' => $content->filename, 'type' => 'video/mp4'],
                ]
            ]
        ]);
    }
    else {
        if (!empty($model_eav['url'])) {
            echo \wbraganca\videojs\VideoJsWidget::widget([
                'options' => [
                    'class' => 'video-js vjs-default-skin vjs-big-play-centered',
                    'poster' => "",
                    'controls' => true,
                    'preload' => 'auto',
                    'width' => '900',
                    'height' => '900',
                ],
                'tags' => [
                    'source' => [
                        ['src' => $model_eav['url'], 'type' => 'video/mp4'],
                    ]
                ]
            ]);
        }
    }
    ?>
    <div class="page_annotation">
        <?= $model_eav['annotation'] ?>
    </div>
    <div class="clearfix"></div>
    <div class="entity-tags do-not-print">
        <?php if (!empty($tags_model)) : ?>
            <span class="tags-title"><?=Yii::t('app','Tags')?></span>
            <?php
            foreach ($tags_model as $tag) {
                $ttag = mb_strtolower($tag->tag);
                echo "<span class='tags-tag'><a class='tags' href='".Yii::$app->urlManager->createUrl(\yii\helpers\Url::to('/search?q='.rawurlencode('#'.$ttag)), array('lang_id'=>\app\models\Lang::getCurrent()->id))."'>#".$ttag."</a></span>";
            }
            ?>
        <?php endif; ?>
    </div>
</div>

<style>
    .video-js {
        width: auto;
        height: auto;
        min-width: 100%;
    }
</style>