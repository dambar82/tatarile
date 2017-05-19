<div class="col-xs-4 col-sm-4 col-md-4 views_row">
    <div class="views_row_inside related_margin">
        <div class="views_row_content">
            <div class="entity_type">
                <span class="type_1"></span>
            </div>
            <div class="entity_img">
                <a href="<?= \app\components\UrlHelper::createEntityUrl($model['entity_id'])?>">
                    <?= \app\modules\file\widgets\Thumbnail::widget(['id' => $model['entity_id']])?>
                </a>
            </div>
            <div class="entity_title">
                <div class="field_content"><a href="<?= \app\components\UrlHelper::createEntityUrl($model['entity_id'])?>"><?=$model['title'];?></a></div>
            </div>
            <div class="entity_razdel">
                <span>
                    <?php
                        if (!empty($model['subject']))
                            echo $model['subject'];
                    ?>
                </span>
            </div>
        </div>
    </div>
</div>
