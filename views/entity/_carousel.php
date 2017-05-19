<div id="myCarousel_<?=$index?>" class="article-slider">
        <?php
        foreach ($data as $item) {
            if ($item['filename']) {
                echo '<div class="item"><a class="colorbox article_group" href="' . $item['filename'] . '">'. \yii\bootstrap\Html::img($item['filename'], ['class' => 'img-responsive', 'alt' => $item['title']]) . '</a><div class="carousel-caption"><div class="carousel-caption-title">'.$item['title'].'</div>
                            <div class="carousel-caption-descr"><p class="field-content">'.$item['description'].'</p><div class="caption-descr-more"></div></div>
                        </div>
                    </div>';
            }
        }
        ?>
</div>

<style type="text/css">
    .item{
        background: #333;
        text-align: center;
    }
    .carousel{
        margin-top: 20px;
    }
</style>

<?php
$script = <<< JS
$('#myCarousel_$index').slick({
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear'
});
$('#myCarousel_$index').on('beforeChange', function(event, slick, currentSlide, nextSlide){
      $(this).find('.carousel-caption-descr.show').find('.caption-descr-more').click();
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
