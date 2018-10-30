<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use kartik\switchinput\SwitchInput;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;
use kartik\file\FileInput;

$labels = ArrayHelper::map(\app\models\Lang::find()->all(),'id','url');

/* @var $this yii\web\View */
/* @var $model app\backend\models\Entity */
/* @var $form yii\widgets\ActiveForm */

$s_prop = \app\backend\models\EntityProperty::find()->all();
$property_type = ArrayHelper::map($s_prop,'id','type_id');
$property_name = ArrayHelper::map($s_prop,'id','title');

$subcategories = [];

if(!$model->isNewRecord && $model->category_id > 0) {
    $subcategories = \app\backend\models\Subject::getAllSubSubjectsWithLang($model->category_id);
    $checked_sub  = \app\backend\models\EntitySubsubjectEav::findAll([
        'entity_id' => $model->id
    ]);
    foreach ($checked_sub as $sub) {
        if(isset($subcategories[$sub->subject_id])) {
            $subcategories[$sub->subject_id] = [
                'title' => $subcategories[$sub->subject_id],
                'checked' => true
            ];
        }
    }
    foreach ($subcategories as $subcategoryID => $subcategoryVal) {
        if(!is_array($subcategoryVal))
            $subcategories[$subcategoryID] = [
                'title' => $subcategoryVal,
                'checked' => false
            ];
    }
}

foreach ($labels as $key => $label)
{
    $i =1;
    foreach (\app\backend\models\EntityTags::find()->where(['lang_id' => $key])->all() as $tag_val) {
        $tags[$key][$i] = $tag_val->tag;
        $i++;
    }
}
$uploadPath = Yii::getAlias("@web/files/thumb/");

$thumbNailPluginOptions = $uploadPath.$model['thumbnail'];

if(empty($model['thumbnail']))
    $thumbNailPluginOptions = '';
if (empty($model->id)) {
    $del = 0;
}
else {
    $del = $model->id;
}
?>

<div class="article-form" data-entity-id="<?=!$model->isNewRecord?$model->id:0?>">

    <?php $form = ActiveForm::begin([
                        'id' => 'article-form',
                        'options' => [
                            'enctype' => 'multipart/form-data'
                         ],
    ]); ?>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#admin_panel_1">Основное</a></li>
        <li><a data-toggle="tab" href="#admin_panel_2">SEO-оптимизация</a></li>
        <li><a data-toggle="tab" href="#admin_panel_3">Содержание</a></li>
        <li><a data-toggle="tab" href="#admin_panel_4">О статье</a></li>
    </ul>

    <div class="tab-content" style="margin-top: 30px;">
        <div id="admin_panel_1" class="tab-pane fade in active">
            <div class="col-xs-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-cog" aria-hidden="true"></i> Готовность статьи</h3>
                    </div>
                    <div class="panel-body">
                        <?= $form->field($model, 'cor')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onColor' => 'success',
                                'offColor' => 'danger',
                                'onText' => 'Готово',
                                'offText' => 'Не готов',
                                'handleWidth'=>60,
                            ],
                        ])->label('Готовность текста')?>

                        <?= $form->field($model, 'image_cor')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onColor' => 'success',
                                'offColor' => 'danger',
                                'onText' => 'Готово',
                                'offText' => 'Не готов',
                                'handleWidth'=>60,
                            ],
                        ])->label('Готовность изображений')?>

                        <?= $form->field($model, 'ready')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onColor' => 'success',
                                'offColor' => 'danger',
                                'onText' => 'Готово',
                                'offText' => 'Не готов',
                                'handleWidth'=>60,
                            ],
                        ])->label('Статья готова')?>

                        <?= $form->field($model, 'comments')->textarea(['rows' => 4])->label('Комментарии для корректоров')?>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-cog" aria-hidden="true"></i> Основная информация</h3>
                    </div>
                    <div class="panel-body">
                        <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onColor' => 'success',
                                'offColor' => 'danger',
                                'onText' => 'ВКЛ',
                                'offText' => 'ВЫКЛ',
                            ],
                        ])?>

                        <?= $form->field($model, 'popular')->widget(SwitchInput::classname(), [
                            'pluginOptions' => [
                                'onColor' => 'success',
                                'offColor' => 'danger',
                                'onText' => 'На главную',
                                'offText' => 'Не показывать',
                                'handleWidth'=>60,
                            ],
                        ])->label('Популярность')?>

                        <?= $form->field($model, 'user')->dropDownList(ArrayHelper::map(\webvimark\modules\UserManagement\models\User::find()->all(),'id','username')) ?>

                        <?= $form->field($model, "thumbnail")->widget(FileInput::classname(), [
                            'options'=>[
                                'accept'=>'image/*',
                                'multiple'=>false
                            ],
                            'pluginOptions' => [
                                'initialPreview'=>$thumbNailPluginOptions,
                                'initialPreviewAsData'=>true,
                                'overwriteInitial'=>true,
                                'maxFileSize'=>\app\components\ConfigHelper::getConfigByName('maxImageSize'),
                                'allowedFileExtensions'=>\app\components\ConfigHelper::getExtensionByName('allowedImageExtensions'),
                                'showRemove' => true,
                                'removeClass' => 'btn btn-danger',
                                'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
                                'showUpload' => false,
                            ],
                            'pluginEvents' => [
                                "fileclear" => "function(e) { 
                                    var filename = e.target.defaultValue;
                                    $.ajax({
                                        'data' : {'filename': filename,'id': $del},
                                        'dataType' : 'json',
                                        'success' : function(data) {
                                            console.log('deleted');
                                        },
                                        'type' : 'post',
                                        'url' : '/backend/entity/delete_thumb'
                                    }); 
                                   }"
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-tree" aria-hidden="true"></i> Категории</h3>
                    </div>
                    <div class="panel-body">
                        <?= $form->field($model, 'category_id')->dropDownList(\app\backend\models\Subject::getAllSubjectsWithLang(),['prompt' => 'Выберите категорию...']) ?>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-retweet" aria-hidden="true"></i> <?=Yii::t('app','Related Entity ID')?></h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $related = $model->loadRelatedProductsArray();
                        ?>

                        <?=
                        \app\backend\widgets\Select2Ajax::widget([
                            'initialData' => $related,
                            'form' => $form,
                            'model' => $model_related,
                            'modelAttribute' => 'related_entity_id',
                            'multiple' => true,
                            'searchUrl' => '/backend/entity/ajax-related-product',
                            'additional' => [
                                'placeholder' => 'Найти похожие материалы',
                            ],
                        ]);
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <div id="admin_panel_2" class="tab-pane fade">
            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-cogs" aria-hidden="true"></i> SEO</h3>
                        </div>
                        <div class="panel-body">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'slug',[
                                'template' => '{label}<div class="input-group">
                                                    <span class="input-group-addon backend-generate-slug-addon">
                                                        <a href="#" class="btn backend-generate-slug"><i class="fa fa-code" aria-hidden="true"></i></a>
                                                    </span>
                                                    {input} 
                                              </div>{error}',
                            ])->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, "description")->widget(Widget::className(), [
                                'settings' => [
                                    'lang' => 'ru',
                                    'minHeight' => 200,
                                    'plugins' => [
                                        'fontcolor',
                                        'table',
                                        'fullscreen',
                                    ]
                                ],
                                'plugins' => [
                                    'longtire' => 'app\backend\assets\ImperaviTireAsset',
                                    'kavychki' => 'app\backend\assets\KavychkiAsset',
                                ]
                            ])?>

                            <?= $form->field($model, 'keywords',[
                                'template' => '{label}<div class="input-group">
                                                    <span class="input-group-addon backend-generate-keywords-addon">
                                                        <a href="#" class="btn backend-generate-keywords"><i class="fa fa-code" aria-hidden="true"></i></a>
                                                    </span>
                                                    {input} 
                                              </div>{error}',
                            ])->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-tree" aria-hidden="true"></i> Фильтры</h3>
                        </div>
                        <div class="panel-body">
                            <label class="control-label" for="subcategory"><?=Yii::t('app','Subcategories')?></label>
                            <div class="subcategory-checker">
                                <?php
                                foreach ($subcategories as $subcategoryID => $subcategoryVal) {
                                    ?>
                                    <div class="checkbox checkbox-primary">
                                        <label>
                                            <input type="checkbox" name="subcategory[<?=$subcategoryID?>]"<?php if($subcategoryVal['checked']) echo ' checked';?>> <?=$subcategoryVal['title']?>
                                        </label>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <?= $form->field($model, 'event_date_begin',[
                                        'addon'=>['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
                                        'options'=>['class'=>'drp-container form-group']
                                    ])->widget(DateRangePicker::classname(), [
                                        'useWithAddon'=>true,
                                        'pluginOptions'=>[
                                            'singleDatePicker'=>true,
                                            'showDropdowns'=>true,
                                            'locale'=>['format' => 'DD.MM.YYYY']
                                        ]
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-2">
                                    <?=$form->field($date_model,'d_1')->dropDownList([
                                        '1' => 'н.э.',
                                        '0' => 'до н.э.'
                                    ])->label(Yii::t('app','D 1'));
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <?= $form->field($model, 'event_date_end',[
                                        'addon'=>['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
                                        'options'=>['class'=>'drp-container form-group']
                                    ])->widget(DateRangePicker::classname(), [
                                        'useWithAddon'=>true,
                                        'pluginOptions'=>[
                                            'singleDatePicker'=>true,
                                            'showDropdowns'=>true,
                                            'locale'=>['format' => 'DD.MM.YYYY']
                                        ]
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-2">
                                    <?=$form->field($date_model,'d_2')->dropDownList([
                                        '1' => 'н.э.',
                                        '0' => 'до н.э.'
                                    ])->label(Yii::t('app','D 1'));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="admin_panel_3" class="tab-pane fade">
            <?php //добавить настройку в админке
            if ($model->entity_type_id ==1) {
                if (empty($model_content)) {
                    $model_content=NULL;
                    $max_content = 0;
                }
                else {
                    $max_content = \app\backend\models\ArticleContent::find()->select('sequence')->where(['article_id' => $model->id])->max('sequence');
                }
                if (empty($model_image_eav)) {$model_image_eav=NULL;}
                echo $this->render('content_article',
                    [
                        'form'=> $form,
                        'entity_id'=>$model->id,
                        'max_content' => $max_content,
                        'model_content' => $model_content,
                        'model_image_eav' => $model_image_eav,

                    ]);
            }
            if ($model->entity_type_id ==2) {
                echo $this->render('content_video',
                    [
                        'form'=> $form,
                        'model_video' => $model_video,
                    ]);
            }

            if ($model->entity_type_id ==3) {
                echo $this->render('content_audio',
                    [
                        'form'=> $form,

                    ]);
            }
            if ($model->entity_type_id ==4) {
                echo $this->render('content_pdf',
                    [
                        'form'=> $form,
                        'model_pdf' => $model_pdf,
                        'model' => $model,
                    ]);
            }
            ?>
            <div class="clearfix"></div>

        </div>
        <div id="admin_panel_4" class="tab-pane fade">
            <div class="col-xs-12"> <!---свойства -->
                <?php if (!empty($model_eav)) {?>
                    <h4>Свойства</h4>
                    <div class="panel-group" id="property" style="margin-bottom:30px;">
                        <?php
                        foreach ($model_eav as $i=>$value) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#property" href="#collapse_<?=$i?>"><?=Yii::t('app',$property_name[$i])?></a></h4>
                                </div>
                                <div id="collapse_<?=$i?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <?php
                                        foreach ($value as $j=>$val) {
                                            switch ($property_type[$val->property_id]) {
                                                case 1:
                                                    echo $form->field($val, "[$j][$i]value")->textInput()->label(Yii::t('app',$labels[$val->lang_id]));
                                                    break;
                                                case 2:
                                                    echo $form->field($val, "[$j][$i]value")->widget(Widget::className(), [
                                                        'settings' => [
                                                            'lang' => 'ru',
                                                            'minHeight' => 200,
                                                            'plugins' => [
                                                                'fontcolor',
                                                                'table',
                                                                'fullscreen',
                                                            ]
                                                        ],
                                                        'plugins' => [
                                                            'longtire' => 'app\backend\assets\ImperaviTireAsset',
                                                            'kavychki' => 'app\backend\assets\KavychkiAsset',
                                                        ]
                                                    ])->label(Yii::t('app',$property_name[$val->property_id].'_'.$labels[$val->lang_id]));
                                                    break;
                                                case 3:
                                                    $val->value =  ArrayHelper::map(\app\backend\models\EntityTags::find()->where(['lang_id' => $j,'entity_id'=> $model->id])->all(),'id','tag');
                                                    echo $form->field($val, "[$j][$i]value")->widget(Select2::classname(), [
                                                        'options' => ['placeholder' => 'Select a tag ...', 'multiple' => true],
                                                        'pluginOptions' => [
                                                            'tags' => true,
                                                            'tokenSeparators' => [','],
                                                            'maximumInputLength' => 50,
                                                            'allowClear' => true
                                                        ],
                                                        'pluginEvents' => [
                                                            "select2:unselect" => "function(e) {                                                                
                                                                var del = e.params.data.text;
                                                                $.ajax({
                                                                    'data' : {'title': del, 'id': $del, 'lang': $j},
                                                                    'dataType' : 'json',
                                                                    'success' : function(data) {
                                                                        console.log('удалено');
                                                                    },
                                                                    'type' : 'post',
                                                                    'url' : '/backend/entity/delete_tag'
                                                                });
                                                            }",
                                                        ]
                                                    ])->label(Yii::t('app',$labels[$val->lang_id]));
                                                    break;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<div class="clearfix"></div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-newspaper-o"></i> '.Yii::t('app','Save') : Yii::t('app','Updates'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php
        if (!$model->isNewRecord) {

            echo '<a href="'.\app\components\UrlHelper::createEntityUrl($model->id).'" class="btn btn-info" target="_blank"> Предпросмотр </a>';
        }
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>