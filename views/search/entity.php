<div class="col-xs-4 col-sm-4 col-md-4 views_row">
    <div class="views_row_inside">
        <div class="views_row_content">
            <?php
            $model->setEav();
            $props = \app\components\GetEntity::getProperties($model->id,['title','annotation'],true);
            ?>
            <div class="entity_type">
                <span class="type_<?= $model->entity_type_id?>"></span>
            </div>
            <div class="entity_img">
                <a href="<?= \app\components\UrlHelper::createEntityUrl($model->id)?>">
                    <?= \app\modules\file\widgets\Thumbnail::widget(['id' => $model->id])?>
                </a>
            </div>
            <div class="entity_title">
                <div class="field_content"><a href="<?= \app\components\UrlHelper::createEntityUrl($model->id)?>"><?=$props['title'];?></a></div>
            </div>
            <div class="entity_annotation">
                <div class="field_content"><?=$props['annotation'];?></div>
            </div>
            <div class="entity_razdel">
                <span><?php if(isset($parentSubjects[$model->category_id])) echo $parentSubjects[$model->category_id];?></span>
            </div>
        </div>
    </div>
</div>
