/**
 * Created by User 50 on 21.11.2016.
 */

$('.backend-generate-slug-addon').on('click',function () {
    var article_title = $('#entity-title').val();
    $.ajax({
        'data' : {'title': article_title},
        'dataType' : 'json',
        'success' : function(data) {
            $('#entity-slug').val(data.slug);
        },
        'type' : 'post',
        'url' : '/backend/entity/generate-slug?id='+$('.article-form').attr('data-entity-id')
    });
});
$('.backend-generate-keywords-addon').on('click',function () {
    $('#entity-keywords').val($('#entity-title').val());
});
$('.js_add_textarea').on('click',function () {
    $.ajax({
        'data' : {'seq': $('#sequence_index').val()},
        'dataType' : 'html',
        'success' : function(data) {
            $('.content_body').append(data);
            $('#sequence_index').get(0).value++;
        },
        'type' : 'post',
        'url' : '/backend/entity/generate-content-block'
    });

});

$('.js_add_audio').on('click',function () {
    $.ajax({
        'data' : {'seq': $('#sequence_index').val()},
        'dataType' : 'html',
        'success' : function(data) {
            $('.content_body').append(data);
            $('#sequence_index').get(0).value++;
        },
        'type' : 'post',
        'url' : '/backend/entity/generate-content-audio'
    });

});

$('.js_add_image').on('click',function () {
    $.ajax({
        'data' : {'seq': $('#sequence_index').val()},
        'dataType' : 'html',
        'success' : function(data) {
            $('.content_body').append(data);
            $('#sequence_index').get(0).value++;
            $('.kv-file-upload').css('display','none');
        },
        'type' : 'post',
        'url' : '/backend/entity/generate-content-image'
    });
});
$('#entity-category_id').on('change',function () {
    var id = parseInt($(this).val());
    if(id > 0) {
        $.ajax({
            'data' : {'id': $(this).val()},
            'dataType' : 'json',
            'success' : function(data) {
                var subcategoryCheckerVal = "";
                $.each(data,function (i, val) {
                    subcategoryCheckerVal += '<div class="checkbox checkbox-primary"><label><input type="checkbox" name="subcategory['+i+']"/> '+val+'</label></div>';
                });
                $('.subcategory-checker').html(subcategoryCheckerVal);
            },
            'type' : 'post',
            'url' : '/backend/subject/sub-subjects'
        });
    }
    else {
        $('.subcategory-checker').html("");
    }
});

$('.js_delete_content_text').on('click',function() {
    var content_id = $(this).attr('data-id');
    var entity_id = $(this).attr('data-model');
    var divname = $(this).parent().parent().attr('id');
    $.ajax({
        'data' : {'content_id': content_id,'model_id': entity_id},
        'dataType' : 'json',
        'success' : function(data) {
            console.log('deleted');
            $('#'+divname).remove();
            console.log($(this).parent().parent().remove());
        },
        'type' : 'post',
        'url' : '/backend/ajax-response/delete_article_content'
    });
});

$('.edit_translate').on('click',function () {
    var field = $(this).attr('data-id');
    $.ajax({
        'data' : {'field': field},
        'dataType' : 'html',
        'success' : function(data) {
            $("#translate-form").find('.modal-title').html('Редактирование');
            $("#translate-form").find('.modal-body').html(data);
            $('#action').val('update');
            $("#translate-form").modal('show');
        },
        'type' : 'post',
        'url' : '/backend/ajax-response/translate-modal?action=update'
    });
});

$('.save-translate-words').on('click',function () {
    var form = $('.translate-form');
    var disabled = form.find(':input:disabled').removeAttr('disabled');
    $.ajax({
        'data' : form.serializeArray(),
        'dataType' : 'json',
        'async': false,
        'success' : function(data) {
            if (data) {
                var parent_cont = $('.translate_body').find("[data-name='"+data.word+"']");

                if (parent_cont.length > 0) {
                    $.each( data, function( key, value ) {
                        if (key != 'word') {
                            var lang_cont = parent_cont.find("[data-name='"+(parseInt(key))+"']");
                            lang_cont.html(value);
                        }
                    });
                }
                else {
                    var append =
                        '<div class="translate-row" style="height: 45px;">' +
                            '<div class="col-md-3">' +
                                '<div class="form-group">' +
                                    '<a href="javascript://" class="edit_translate" data-id="'+data.word+'">' +
                                        '<i class="fa fa-pencil"></i> ' +
                                    '</a>' +
                                    data.word+
                                '</div>' +
                            '</div>';
                    $.each( data, function( key, value ) {
                        if (key != 'word') {
                            append +=
                                '<div class="col-md-3" data-name="'+data.word+'">' +
                                    '<div class="form-group" data-name="'+key+'">' +
                                        value +
                                    '</div>' +
                                '</div>';
                        }
                    });
                    append += '</div>';
                    $('.translate_body').append(append);
                }
                $("#translate-form").modal('hide');
            }
            else {
                $("#translate-form").find('.modal-body').append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle fa-2x"></i> Поле "ключ" не заполнено, либо такой ключ уже существует</div>');
            }
        },
        'type' : 'post',
        'url' : '/backend/ajax-response/save-translate'
    });
});

$('.add_translate').on('click',function () {
    var field = '';
    $.ajax({
        'data' : {'field': field},
        'dataType' : 'html',
        'success' : function(data) {
            $("#translate-form").find('.modal-title').html('Редактирование');
            $("#translate-form").find('.modal-body').html(data);
            $('#action').val('create');
            $("#translate-form").modal('show');
        },
        'type' : 'post',
        'url' : '/backend/ajax-response/translate-modal?action=create'
    });
});

