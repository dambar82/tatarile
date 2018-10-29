<?php
/* @var $randomHashTags array */
/* @var $lang_url string */
?>

<?php if (!empty($randomHashTags)): ?>
    <div class="hash-tag">
        <div class="hash-tag--label">
            <span><?= Yii::t('app','or use hashtags');?></span>
        </div>
        <div class="hash-tag--content">
            <div class="hash-tag--links">
                <?php
                    foreach ($randomHashTags as $randomHashTag):
                    $hashtag = mb_strtolower($randomHashTag->tag);
                ?>
                    <a href="<?=Yii::$app->urlManager->createUrl(\yii\helpers\Url::to('/search?q='.rawurlencode('#'.$hashtag)), array('lang_id'=>\app\models\Lang::getCurrent()->id))?>" title="#<?=$hashtag?>" class="random-tag">#<?=$hashtag?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <button class="hash-tag--update update-tags-btn"><i class="glyphicon glyphicon-refresh"></i></button>
    </div>
<?php endif; ?>

<?php
$script = <<< JS
    $(document).ready(function(e) {
        $('.random-tag').succinct({
            size: 18
        });
        $('.update-tags-btn').on('click',function(e) {
            var obj = $(this);
            if(!obj.hasClass('update-tags-btn-disable')) {
                obj.addClass('update-tags-btn-disabled');
                $.ajax({
                    type: "GET",
                    url: '$lang_url/search/update-tags',
                    dataType: "html",
                    success: function(response){
                        var block = obj.parent().find('.hash-tag--links');
                        block.html(response);
                        obj.removeClass('update-tags-btn-disabled');
                        $('.random-tag').succinct({
                            size: 18
                        });
                    }
                });
            }
        });
    });
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>
