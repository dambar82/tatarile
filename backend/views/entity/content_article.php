<?php

use vova07\imperavi\Widget;
use kartik\file\FileInput;

$labels = \yii\helpers\ArrayHelper::map(\app\models\Lang::find()->orderBy('id DESC')->all(),'id','url');
?>
<div class="col-xs-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm btn-top-margin">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Добавить
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript://" class="js_add_textarea"><i class="fa fa-text-width" aria-hidden="true"></i> Текстовое поле</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript://" class="js_add_image"><i class="fa fa-file-image-o" aria-hidden="true"></i> Изображение</a></li>
                    </ul>
                </div>
            </div>
            <h3 class="panel-title"><i class="fa fa-paragraph"></i> Содержание статьи</h3>
        </div>
        <div class="panel-body content_body">
            <?php if (!empty($model_content)) {$count = count($model_content);} else {$count =0;}?>
            <input type = "hidden" value ='<?= $max_content?>' id="sequence_index">
            <?php
            if (!empty($model_content)) {
                foreach ($model_content as $content_index=>$content_value) {
                    if (isset(current($content_value)->content_id)) {
                        if (\app\backend\models\ArticleContent::find()->select('content_type')->where(['id'=>current($content_value)->content_id])->scalar() == 1)
                        {
                            echo '<div class="article_content article_content_'.$content_index.'" id="tex__"'.$content_index.'>';
                            echo '<div class="article_content_buttons">
                                <a href="javascript://" data-model="'.$entity_id.'" data-id="'.$content_index.'" class="btn btn-default btn-sm admin_btn js_delete_content_text"><i class="fa fa-times"></i></a>
                                <a href="javascript://" data-model="'.$entity_id.'" data-id="'.$content_index.'" class="btn btn-default btn-sm admin_btn"><i class="fa fa-arrows"></i></a>
                            </div>';
                            foreach ($content_value as $value_index=>$value) {
                                $value->value = \yii\bootstrap\Html::decode($value->value);
                                echo '<div class="col-md-4">';
                                echo $form->field($value, "[$content_index][$value->lang_id]value")->widget(Widget::className(), [
                                    'options' => [
                                        'data-id' => $value->lang_id,
                                    ],
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
                                        'linkes' => 'app\assets\ImperaviAsset',
                                        'longtire' => 'app\backend\assets\ImperaviTireAsset',
                                        'kavychki' => 'app\backend\assets\KavychkiAsset',
                                    ]
                                ])->label(Yii::t('app',$labels[$value->lang_id]));
                                echo '</div>';
                            }
                            echo '</div><div class="clearfix"></div>';
                        }
                        else {
                        }
                    }
                    else{
                        echo '<div class="article_content" id="tex__"'.$content_index.'>';
                            echo '<div class="article_content_buttons">
                                    <a href="javascript://" data-model="'.$entity_id.'" data-id="'.$content_index.'" class="btn btn-default btn-sm admin_btn js_delete_content_text"><i class="fa fa-times"></i></a>
                                    <a href="javascript://" data-model="'.$entity_id.'" data-id="'.$content_index.'" class="btn btn-default btn-sm admin_btn"><i class="fa fa-arrows"></i></a>
                                </div>';
                            echo '<div class = "col-xs-3">';
                            echo $form->field($content_value, "[{$content_index}]filename")->widget(FileInput::classname(), [
                                'options'=>[
                                    'multiple'=>false,
                                    'accept'=>'image/*'
                                ],
                                'pluginOptions' => [
                                    'initialPreview'=>[
                                        Yii::getAlias("@web/files/articles/").$content_value['filename'],
                                    ],
                                    'initialPreviewAsData'=>true,
                                    'overwriteInitial'=>true,
                                    'showUpload' =>false,
                                    'maxFileSize'=>\app\components\ConfigHelper::getConfigByName('maxImageSize'),
                                    'allowedFileExtensions'=>\app\components\ConfigHelper::getExtensionByName('allowedImageExtensions'),
                                ],
                            ]);
                            echo '</div>';
                            echo '<div class = "col-xs-9">
                                        <div class="row">';
                            if (!empty($model_image_eav)) {
                                foreach ($model_image_eav[$content_index] as $j => $val) {
                                    echo '<div class = "col-xs-4">';
                                    echo $form->field($val, "[{$content_index}][{$val->lang_id}]title")->textInput(['maxlength' => true])->label(Yii::t('app',$labels[$val->lang_id]));
                                    echo $form->field($val, "[{$content_index}][{$val->lang_id}]description")->textarea()->label(Yii::t('app',$labels[$val->lang_id]));

                                    echo '</div>';
                                }
                            }

                            echo '</div></div><div class="clearfix"></div>';
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
        <div class="" style="margin: 15px;">
            <a href="javascript://" class="btn btn-success js_add_textarea"><i class="fa fa-text-width" aria-hidden="true"></i> Текстовое поле</a>
            <a href="javascript://" class="btn btn-primary js_add_image"><i class="fa fa-file-image-o" aria-hidden="true"></i> Изображение</a>
        </div>
    </div>
</div>