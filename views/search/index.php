<?php
$randomHashTags = [];
for($i = 0; $i<3; $i++) {
    $notTag = "";
    if(count($randomHashTags) > 0) {
        foreach ($randomHashTags as $randomHashTagN) {
            if(strlen($notTag) > 0)
                $notTag .=" AND ";
            $notTag .= "`tag` <>'".$randomHashTagN->tag."'";
        }
    }
    $randomHashTag = \app\backend\models\EntityTags::find()
        ->where(['lang_id' => \app\models\Lang::getCurrent()->id])
        ->andWhere($notTag)
        ->offset(0)->limit(1)
        ->orderBy(new \yii\db\Expression('rand()'))
        ->all();
    if(count($randomHashTag) > 0)
        $randomHashTags[] = $randomHashTag[0];
}
?>
<div class="top_filter">
    <div class="container-fluid">
        <div class="row">
            <div class="top_filter-content">
                <div class="col-sm-2 col-md-3 col-lg-3 hidden-xs hidden-sm tematic-img-block">

                </div>

                <div class="col-xs-12 col-sm-10 col-md-9 col-lg-6 filter_search">
                    <div class="filter_search_content">
                        <form id="search-input-filter" class="filter-serializer">
                            <input type="text" name="q" value="<?=$search_q?>" placeholder="<?= Yii::t('app','Enter search term'); ?>" />
                        </form>
                        <?php
                        if(!empty($randomHashTags)) {
                            ?>
                            <div class="dynamic_hash_tag">
                                <div class="dynamic_hash_tag_content">
                                    <div class="dynamic_hash_tag_span">
                                        <span><?= Yii::t('app','or use hashtags');?></span>
                                    </div>
                                    <div class="dynamic_hash_tag_wrap">
                                        <div class="dynamic_hash_tag_cont">
                                            <?=$this->render('@app/views/search/random-tagslist',[
                                                'randomHashTags' => $randomHashTags,
                                                'lang_url' => $lang_url
                                                ])?>
                                            </div>
                                            <button class="update-tags-btn"></button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                    </div>
                </div>

                <div class="col-lg-3 hidden-xs hidden-sm hidden-md tematic-img-block">
                    <div class="row_content">
                        <div class="top_filter_tematic">
                            <img class="img-responsive img-top-filter" src="/images/tematik_search_2.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="filter_container filter-container-bg view_grid" id="filter-dynamic-part">
<?php

use yii\helpers\Html;
echo $this->render('search-list',[
    'entity_types' => $entity_types,
    'entities' => $entities,
    'selected_types' => $selected_types,
    'limit' => $limit,
    'pagination' => $pagination,
    'search_q' => $search_q,
    'dateStart' => $dateStart,
    'dateEnd' => $dateEnd,
    'dateFilter' => $dateFilter,
    'parentSubjects' => $parentSubjects,
    'category_id' => $category_id,
    'subcats' => $subcats,
    'selectedSubcat' => $selectedSubcat,
    'type' => $type,
    'char' => $char,
    'popular' => $popular,
    'entitiesPop' => $entitiesPop,
    'lang_url' => $lang_url
]);
?>
</div>
<?php
$script = <<< JS
    var sendFilterAJAX = null;
    function setSliderHandle(i, value) {
        var r = [null,null];
        r[i] = value;
        slider.noUiSlider.set(r);
    }
    function serializeAllFilters() {
        var filterSerialize = "";
        var filters = $('.filter-serializer').not('.ignored');
        filters.each(function() {
            var ser = $(this).find("*").not('.ignored, input[name="q"], *[name="category_id"]:checked').serialize();
            
            if(ser.length > 0) {
               if(filterSerialize.length != 0)
                   filterSerialize +='&';
               filterSerialize += ser;
            }
            var qf = $(this).find('input[name="q"]');
            if(qf.length > 0 && qf.val().trim() != '') {
                if(filterSerialize.length != 0)
                   filterSerialize +='&';
                filterSerialize += 'q='+encodeURIComponent(qf.val().trim());
                $('#alphabet-filter input[type="checkbox"]').attr('checked',null);

            }
            var cf = $(this).find('*[name="category_id"]:checked');
            if(cf.length > 0 && parseInt(cf.val()) > 0) {
                if(filterSerialize.length != 0)
                   filterSerialize +='&';
                filterSerialize += 'category_id='+parseInt(cf.val());
            }
        });
        var checkedChar = $('#alphabet-filter input:checked');
        if(checkedChar.length > 0) {
            if(filterSerialize.length != 0)
                   filterSerialize +='&';
            filterSerialize += 'char='+encodeURIComponent(checkedChar.attr('data-char'));
        }
        return filterSerialize;
    }
    function sendFilter(serialize) {
        var filter = $('#filter');
        var filterSerialize = serializeAllFilters();
        var urlAr = window.location.href.split('?');
        var oldSerialize = urlAr.length > 1?urlAr[1]:"";
        var dataSerialize;
        var noUpdate = $('.filter-serializer[data-no-update=1]').length > 0;
        if(typeof serialize != 'undefined') {
            dataSerialize = serialize;
        }
        else {
            dataSerialize = filterSerialize;
        }
        if(!noUpdate && (typeof serialize != 'undefined' || oldSerialize != dataSerialize)) {
            var bgAjax = filter.find('.bg_ajax');
            if(typeof serialize == 'undefined') {
                var stateObj = { foo: "Entity filter" };
                var path = urlAr[0]+(dataSerialize.length>0?"?":"")+dataSerialize;
                history.pushState(stateObj, "Entity filter", path);
            }
            if(sendFilterAJAX)  {
                sendFilterAJAX.abort();
                sendFilterAJAX = null;
            }
            sendFilterAJAX = $.ajax({
                type: "GET",
                url: urlAr[0],
                dataType: "html",
                data: dataSerialize,
                success: function(response){
                    sendFilterAJAX = null;
                    $('#filter-dynamic-part').html(response);
                    filter = $('#filter');
                    filterSerialize = serializeAllFilters();
                    if(filterSerialize != dataSerialize) {
                        path = urlAr[0]+(filterSerialize.length>0?"?":"")+filterSerialize;
                        history.replaceState(stateObj, 'Entity filter',path);
                    }
                    bgAjax.hide();
                    sliderInit();
                    View(getCookie("view"));
                }
            });
        }
    }
    function urlQueryToJSON(query) {
      if(typeof query == 'undefined') {
          query = location.search.substr(1);
          query = query.toString();
      }
      var result = {};
      query.split("&").forEach(function(part) {
        var item = part.split("=");
        result[item[0]] = decodeURIComponent(item[1]);
      });
      return result;
    }
    function filterInit() {
        setInterval('sendFilter();',1000);
    }
    function sliderInit() {
        slider = document.getElementById('slider_date');
        var dateStart = document.getElementById("date-start");
        var dateEnd = document.getElementById("date-end");
        var inputs = [dateStart, dateEnd];
        noUiSlider.create(slider, {
            start: [dateStart.value, dateEnd.value],
            connect: true,
            step: 1,
            range: {
                'min': [ -2101 ],
                'max': [ 2101 ]
            }
        });
        slider.noUiSlider.on('update', function( values, handle ) {
            inputs[handle].value = Math.round(values[handle]);
            var handleObj = $(slider).find('.noUi-handle[data-handle="'+handle+'"]');
            var handleInf = handle > 0?$('.field_date_end'):$('.field_date_start');
            if(inputs[handle].value >= 0)
                handleInf.html(inputs[handle].value);
            else
                handleInf.html((-1)*inputs[handle].value+" <span>до н. э.</span>");
        });
        slider.noUiSlider.on('slide', function(e) {
            var filterDate = $('#filter-date');
            filterDate.attr('data-no-update',1);
            $('#TriSeaDefault').attr('checked','checked');
            filterDate.removeClass('ignored');
        });
        slider.noUiSlider.on('set', function(e) {
            var filterDate = $('#filter-date');
            filterDate.attr('data-no-update',0);
        });
        slider.noUiSlider.on('end', function(e) {
            var filterDate = $('#filter-date');
            filterDate.attr('data-no-update',0);
            sendFilter();
        });
        inputs.forEach(function(input, handle) {
            input.addEventListener('change', function(){
                setSliderHandle(handle, this.value);
            });

        });
    }
    $(document).ready(function(e) {
        var filterContainer = $('.filter_container');
        var searchPageDyn = $('#filter-dynamic-part');
        
        sliderInit();
        $(window).on('popstate', function(e) {
            var urlSplit = window.location.href.split('?');
            var getStr = urlSplit.length > 1?urlSplit[1]:"";
            var getAr = urlQueryToJSON(getStr);
            var filterSearchI = $('#search-input-filter').find('input[name="q"]');
            if('q' in getAr) {
                filterSearchI.val(getAr['q']);
            }
            else {
                filterSearchI.val("");
            }
            sendFilter(getStr);
        });
        filterInit();
        filterContainer.on('change','#filter input[type="checkbox"]',function(){
            var obj = $(this);
            if(obj.prop('checked'))
                obj.attr('checked','checked');
            else
                obj.attr('checked',null);
            sendFilter();
        });
        filterContainer.on('change','.updater-select input[type="radio"]',function(e) {      
            sendFilter();            
        });
        filterContainer.on('change','#alphabet-filter input[type="checkbox"]',function(e) {
            var obj = $(this);
            if(obj.prop('checked')) {
                $('#alphabet-filter input[type="checkbox"]').not(obj).attr('checked',null);
                $('#search-input-filter').find('input[name="q"]').val('');
                obj.attr('checked','checked');
            }
            else {
                obj.attr('checked',null);
            }
            sendFilter();
        });
        searchPageDyn.on('change','#TriSeaDefault',function() {
            var filterDate = $('#filter-date');
            if($(this).prop('checked'))
                filterDate.removeClass('ignored');
            else
                filterDate.addClass('ignored');
            sendFilter();
        });
        filterContainer.on('click','#load-entities',function() {
            var but = $(this);
            var parent = but.parent().parent();
            var urlAr = window.location.href.split('?');
            var filter = $('#filter');
            var dataSerialize = urlAr.length > 1?urlAr[1]:"";
            var newpage = parseInt(filter.attr('data-filter-page'))+1;
            if(dataSerialize.length != 0)
                dataSerialize +='&';
            dataSerialize +='pagination=1&page='+(newpage);
            but.parent().remove();
            $.ajax({
                type: "GET",
                url: urlAr[0],
                dataType: "html",
                data: dataSerialize,
                success: function(response){
                    parent.append(response);
                    filter.attr('data-filter-page',newpage);
                }
            });
        });
        $('#search-input-filter').on('submit',function(e) {
            e.preventDefault();
            sendFilter();
        });
        $('#filter-dynamic-part').on('submit','.filter-serializer',function(e) {
            e.preventDefault();
            sendFilter();
        });
        $('.dynamic_hash_tag_cont').on('click','a.random-tag',function(e) {
            e.preventDefault();
            var qf = $('input[name="q"]');
            qf.val($(this).attr('title'));
        });
    });
    $('.entity_view .entity_annotation').succinct({
        size: 220
    });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_END);
?>
