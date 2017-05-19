<?php

use kartik\file\FileInput;

/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 23.11.2016
 * Time: 10:17
 */
$seq_index = intval($_POST['seq'])+1;
$labels = \yii\helpers\ArrayHelper::map(\app\models\Lang::find()->orderBy('id DESC')->all(),'id','url');


?>
<div class = "col-xs-3">
    <?php
    echo '<label class="control-label">'.Yii::t('app','Add Image').'</label>';
    echo FileInput::widget([
        'name' => "ArticleContentImage[{$seq_index}][filename]",
        'id' => 'articlecontentimage-'.$seq_index.'-filename',
        'options'=>[
            'accept'=>'image/*',
            'multiple'=>false
        ],
        'pluginOptions' => [
            'uploadUrl' => '#',
            'overwriteInitial'=>false,
            'maxFileSize'=>\app\components\ConfigHelper::getConfigByName('maxImageSize'),
            'allowedFileExtensions'=>\app\components\ConfigHelper::getExtensionByName('allowedImageExtensions'),
            'showRemove' => true,
            'removeClass' => 'btn btn-danger',
            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
            'showUpload' => false,

        ]
    ]);
    ?>
</div>
<div class = "col-xs-9">
    <div class="row">
    <?php
    foreach ($labels as $lang_key => $lang){
        echo '<div class = "col-xs-4">
                <div class="form-group field-articlecontentimageeav-'.$seq_index.'-'.$lang_key.'-title">';
                    echo '<label class="control-label" for="articlecontentimageeav-'.$seq_index.'-'.$lang_key.'-title">'.Yii::t('app','Image title '.$lang).'</label>';
                    echo \yii\bootstrap\Html::input('text','ArticleContentImageEav['.$seq_index.']['.$lang_key.'][title]','',['class'=>"form-control"]);
                echo '</div>';
                echo '<div class="form-group field-articlecontentimageeav-'.$seq_index.'-'.$lang_key.'-description">';
                    echo '<label class="control-label" for="articlecontentimageeav-'.$seq_index.'-'.$lang_key.'-description">'.Yii::t('app','Image description '.$lang).'</label>';
                    echo \yii\bootstrap\Html::textarea('ArticleContentImageEav['.$seq_index.']['.$lang_key.'][description]','',['class'=>"form-control"]);
                echo '</div>';
        echo '</div>';
    }
    ?>
    </div>
</div>
<div class="clearfix"></div>
