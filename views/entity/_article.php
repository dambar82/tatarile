
<div class="main_image">
    <?=\app\modules\file\widgets\MainImage::widget([
        'image'=>$model->thumbnail,
        'alt'=>$model_eav['title'],
        'thumbnail_title' => $model_eav['thumbnail_title'] = (isset($model_eav['thumbnail_title'])?$model_eav['thumbnail_title']:'')])?>
</div>

<div class="article-index">

    <?php
    if (!empty($content['content'])) {
        foreach ($content['content'] as $key=>$cont) {
            if ($cont['type'] == 'text') {
               echo '<div class="content_text">'.\yii\bootstrap\Html::decode($cont['value']).'</div>';
            }
            if ($cont['type'] == 'image') {
               echo  '<div class="content_image"><a class="colorbox article_group" href="' . $cont['value'][0]['filename'] . '"><img class="img-responsive" src="' . $cont['value'][0]['filename'] . '" alt="' . $cont['value'][0]['title'] . '"></a><div class="content_image_text"><div class="carousel-caption-title">' . $cont['value'][0]['title'] . '</div><p>'.$cont['value'][0]['description'].'</p></div></div>';
           }
             if ($cont['type'] == 'imagearray') {
                echo $this->render('_carousel',[
                    'data' => $cont['value'],
                    'index' => $key
                ]);
            }
        }
    }
    ?>

    <div class="clearfix"></div>
    <div class="entity-tags do-not-print">
        <?php if (!empty($tags_model)) : ?>
            <span class="tags-title">Теги</span>
            <?php
            foreach ($tags_model as $tag) {
                $ttag = mb_strtolower($tag->tag);
                echo "<span class='tags-tag'><a class='tags' href='".Yii::$app->urlManager->createUrl(\yii\helpers\Url::to('/search?q='.rawurlencode('#'.$ttag)), array('lang_id'=>\app\models\Lang::getCurrent()->id))."'>#".$ttag."</a></span>";
            }
            ?>
        <?php endif; ?>
    </div>

    <?php
    if(!empty($content['simular'])) : ?>
        <div class="cont_padding article_similar do-not-print">
            <div class="similar_content">
                <div class="block_h2">
                    <h2><?=Yii::t('app', 'Links from article')?></h2>
                </div>

                <?php
                foreach ($content['simular'] as $value) : ?>
                    <div class="article_similar_row">
                        <div class="row_content">
                            <a href="<?=\app\components\UrlHelper::createEntityUrl($value['entity_id'])?>"><?=$value['title']?></a>
                            <?php
                            if (!empty($value['annotation'])) {
                                $value['annotation'] = preg_replace('#(?:<).*?(?:>)#','',$value['annotation']);
                                $value['annotation'] = trim(preg_replace('| +|', ' ', $value['annotation']));
                                $value['title'] = trim(preg_replace('| +|', ' ', $value['title']));

                                $pos_position = mb_strpos(mb_strtolower(trim($value['annotation'])),mb_strtolower(trim($value['title'])));
                                $tit_lenght = mb_strlen($value['title']);
                                if ($pos_position === 0) {
                                    $value['annotation'] = mb_substr(strip_tags($value['annotation']),$tit_lenght);
                                }

                                echo '<p>'.strip_tags($value['annotation']).'</p>';
                            }
                            ?>
                        </div>
                    </div>
                <?php
                    endforeach; ?>
            </div>
        </div>
    <?php
        endif; ?>
</div>

<?php
$script = <<< JS
    $(document).ready(function(e) {
        $('.article_similar .article_similar_row p').succinct({
            size: 90
        });
        /*var images = $('.article-index .content_image img, .article-index .carousel-inner img');
        $.each(images,function(index,element) {
            var im = $(this);
            $('.article-index').append('<div class="iziModal" data-izimodal-photo-number="'+index+'"><img src="'+im.attr('src')+'" alt="" class="img-responsive"/></div>');
            im.attr('data-izimodal-photo-number',index);
        });
        var iziM = $(".iziModal");
        iziM.uniqueId();
        iziM.iziModal({
            width: 700,
            radius: 5,
            padding: 20,
            group: 'products',
            loop: true,
            fullscreen: true,
            overlayClose: true,
    closeOnEscape: true,
    overlay: true,
        });
        images.on('click',function(e) {
            $('.iziModal[data-izimodal-photo-number='+$(this).attr('data-izimodal-photo-number')+']').iziModal('open');
        });*/
        $('a.article_group').colorbox({
            rel: 'article_group',
            maxWidth: '100%',
            maxHeight: '100%',
            fixed: 'true'
        })
    });

JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
