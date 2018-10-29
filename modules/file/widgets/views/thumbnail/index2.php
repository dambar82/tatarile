<div class="entity-thumbnail">
    <?= \alpiiscky\imagecache\ThumbWidget::widget([
        'image' => $thumbnail,
        'img_class' => '',
        'path' => '',
        'width' => 120,
        'height' => 120,
        'mode' => \alpiiscky\imagecache\Thumb::CROP_CENTER
    ]) ?>
</div>