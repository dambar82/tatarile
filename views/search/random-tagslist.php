<?php
foreach ($randomHashTags as $randomHashTag) {
    $hashtag = mb_strtolower($randomHashTag->tag);
    ?>
    <a href="<?=Yii::$app->urlManager->createUrl(\yii\helpers\Url::to('/search?q='.rawurlencode('#'.$hashtag)), array('lang_id'=>\app\models\Lang::getCurrent()->id))?>" title="#<?=$hashtag?>" class="random-tag">#<?=$hashtag?></a>
    <?php
}
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
                        var block = obj.parent().find('.dynamic_hash_tag_cont');
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
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_END);
?>