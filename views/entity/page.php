<?php
//entity ->(object) $model
//entity_eav -> (array) $model_eav
//article_content => $article_content
use app\backend\models\Subject;
use yii\helpers\Url;
use app\assets\StarAsset;

StarAsset::register($this);
$theme_bg = Subject::find()->select('filename')->where(['id'=>$model->category_id])->scalar();
$EntityStat = \app\backend\models\EntityStatistics::findOne(['entity_id' => $model->id]);
if($user)
    $vote = $model->findVote($user->id);
else
    $vote = NULL;
$site = Yii::$app->params['siteURL'].\app\components\UrlHelper::createEntityUrl($model->id);

Yii::$app->params['activ'] = '1';
?>

<div class="main_block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1 col-lg-3 do-not-print">
                <div class="btn_prev_page">
                    <a class="btn" href="<?=Url::to(Yii::$app->request->referrer)?>"><?=Yii::t('app','back')?></a>
                </div>
            </div>
            <div class="col-md-10 col-lg-6">
                <div class="entity_subject">
                    <span><?=\app\components\GetSubject::getSubjectTitle($model->category_id)?></span>
                </div>
                <h1 class="title" id="page-title"><?= $model_eav['title']; ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="entity_content entity_type_<?= $model->entity_type_id ?>">
    <?php /* if ($theme_bg && $model->entity_type_id != 4) { print '<div class="theme_bg" style="background: url('.Yii::getAlias("@web").$theme_bg.')"></div>'; } */ ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-lg-6 col-md-push-1 col-lg-push-3">
                <div class="entity-index clearfix">

                    <?php

                    echo $this->render($viewFile, [
                        'model' => $model,
                        'model_eav' => $model_eav,
                        'tags_model' => $tags_model,
                        'content' => $content,
                        'user' => $user,
                        'showHide' => $showHide
                    ]);
                    ?>
                    <div class="block_soc_widgets do-not-print">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-3 entity_views soc_widgets_row">
                                <div class="soc_widgets_row_cont my-tbl">
                                    <div class="my-tbl-cell">
                                        <span><?=$EntityStat->viewing_count?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-md-push-6 entity_voting soc_widgets_row">
                                <div class="soc_widgets_row_cont my-tbl">
                                    <div class="my-tbl-cell">
                                        <input id="content-voting" name="input-name" type="number" class="rating" min=0 max=5 step=1 data-size="xs"<?php if(!$user || $vote) echo ' readonly'?> data-entity-id="<?=$model->id?>" value="<?=$EntityStat->votes_count > 0?$EntityStat->votes_sum/$EntityStat->votes_count:0?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-md-pull-3 soc_widgets_row soc_widgets_btns">
                                <div class="row soc_widgets_btns_content">
                                    <div class="col-xs-4 soc_widgets_btn add_favorite">
                                        <div class="soc_widgets_row_cont my-tbl">
                                            <div class="my-tbl-cell">
                                                <a href="javascript://" class="btn js_add_favorite <?=$favorite_active?>" data-id="<?=$model->id?>">В избранное</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 soc_widgets_btn btn_share">
                                        <div class="soc_widgets_row_cont my-tbl">
                                            <div class="my-tbl-cell">
                                                <a class="btn share_soc"><?= Yii::t('app','Link')?></a>
                                                <div id="share" style="">
                                                    <div class="pluso" data-background="transparent" data-options="medium,round,line,horizontal,nocounter,theme=03" data-services="vkontakte,odnoklassniki,facebook,twitter,google,linkedin,evernote,livejournal,moikrug,moimir" data-user="575315987"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 soc_widgets_btn btn_print">
                                        <div class="soc_widgets_row_cont my-tbl">
                                            <div class="my-tbl-cell">
                                                <a href="#" class="btn" onclick="print()">Печать</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php if (!empty($related_model)) : ?>
    <div class="related_entity_block do-not-print">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-lg-6 col-md-push-1 col-lg-push-3 related_entity">
                        <div class="block_h2">
                            <h2><?=Yii::t('app', 'Related material')?></h2>
                        </div>

                        <div class="related-carousel entity_style">
                            <?php
                            foreach ($related_model as $item) {
                                if (!empty($item['title']))
                                echo $this->render('item',[
                                    'model' => $item,
                                ]);
                            }
                            ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php
 $script = <<< JS
    $('.share_soc').on('click',function() {
        $('#share').stop().show();
    });
    $(document).on('click', function (e) {
        if ($(e.target).closest(".share_soc").length === 0) {
            $("#share").hide();
        }
    });

    $('.js_add_favorite').on('click',function() {
        var btn = $(this);
        $.ajax({
            'data' : {'id': $model->id},
            'dataType' : 'json',
            'success' : function(data) {
                btn.toggleClass('flip');
            },
            'type' : 'post',
            'url' : '/user/favorite/add'
        });
    });

    $('.related-carousel').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1500,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true
                }
            },
            {
                breakpoint: 530,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $(document).ready(function(e) {
          if (window.pluso)if (typeof window.pluso.start == "function") return;
          if (window.ifpluso==undefined) { window.ifpluso = 1;
            var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
            s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
            s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
            var h=d[g]('body')[0];
            h.appendChild(s);
          }


        (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.8";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

        $('[data-toggle="popover"]').popover({
            html:'true',
            placement : 'top',
            content: function() {  return $($(this).data('contentwrapper')).html(); }
        });

        var cv = $('#content-voting');
        cv.rating('refresh', {
            'showCaption':false,
            'showClear': false
        });
        cv.on('rating.change',function(e) {
            var obj = $(this);
            obj.rating('refresh', {
                'readonly':true
            });
            $.post('/entity/entity-voting/?id='+obj.attr('data-entity-id'),{
                'sum':obj.val()
            },function(data) {
                if(data['success']) {
                    obj.rating('update', data['vote_avg']);
                }
                else {
                    console.log(data['msg']);
                }
            },'json');
        });
    });




    /**/
    var carselDescr = $('.article-slider .carousel-caption-descr');
    carselDescr.each(function() {
        if ($(this).children('.field-content').height() > 72) {
            $(this).addClass('long-text');
        } else {
            $(this).removeClass('long-text');
        }
    });
    $(window).resize(function() {
        carselDescr.each(function() {
            if ($(this).children('.field-content').height() > 72) {
                $(this).addClass('long-text');
            } else {
                $(this).removeClass('long-text');
            }
        });
    });

    $(".caption-descr-more").click(function() {
        thsBtn = $(this);
        thsText = thsBtn.parent();
        thsText_h = thsText.children('.field-content').outerHeight(true);
        if (!thsText.hasClass('show')) {
            thsText.toggleClass('show').stop().animate({height: thsText_h}, 500);
        } else {
            thsText.toggleClass('show').stop().animate({height: '72px'}, 500);
        }
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);
