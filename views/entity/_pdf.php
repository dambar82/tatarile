<?php
if($model->thumbnail == '')
    $thumbnail = '/images/default.png';
else
    $thumbnail = Yii::getAlias('@web/files/thumb/').$model->thumbnail;

?>
<div class="book-index">
    <div class="row book_preview_content">
        <div class="col-xs-12 col-sm-5 col-md-5 book_image">
            <div class="book_image_content">
                <div class="main_image">
                    <img class="img-responsive" src="<?=$thumbnail?>" alt="<?=$model_eav['title']?>">
                </div>
                <div class="text-center book_read_block">
                    <?php if ($showHide) :?>
                        <a href="#book-modal" class="btn book_read_btn"><?=Yii::t('app','Book read')?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-7 col-md-7 book_other">
            <div class="book_other_content">
                <div class="book_annotation">
                    <?=$model_eav['annotation']?>
                </div>
                <?php if (isset($model_eav['info'])) {
                    echo '<div class="book_info">'.$model_eav['info'].'</div>';
                } ?>
            </div>
        </div>
    </div>
    <?php if (!empty($tags_model)) : ?>
        <div class="entity-tags entity-tags-pdf">
            <span class="tags-title">Теги</span>
            <?php
            foreach ($tags_model as $tag) {
                $ttag = mb_strtolower($tag->tag);
                echo "<span class='tags-tag'><a class='tags' href='".Yii::$app->urlManager->createUrl(\yii\helpers\Url::to('/search?q='.rawurlencode('#'.$ttag)), array('lang_id'=>\app\models\Lang::getCurrent()->id))."'>#".$ttag."</a></span>";
            }
            ?>
        </div>
    <?php endif; ?>
</div>


<div id="modalpdf">

</div>
<?php
if ($showHide) {
    $titlas = "'".$model_eav['title']."'";
    $urlas = "'".$content->filename."'";
    $script = <<< JS
$('.book_read_btn').on('click', function (event) {
    event.preventDefault();
    $('#modalpdf').iziModal('open', this);
});
$("#modalpdf").iziModal({
    title: $titlas,
    theme: '',
    headerColor: '#00ad83',
    overlayColor: 'rgba(0, 0, 0, 0.4)',
    iconColor: '',
    iconClass: null,
    iframe: true,
    iframeURL: $urlas,
    padding: 0,
    fullscreen: true,
    openFullscreen: true,
    overlayClose: true,
    closeOnEscape: true,
    overlay: true,
});
JS;
    $this->registerJs($script);
}
