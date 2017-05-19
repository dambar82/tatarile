<?php

use kartik\file\FileInput;
use yii\helpers\Url;

$seq_index = intval($_POST['seq'])+1;
$labels = \yii\helpers\ArrayHelper::map(\app\models\Lang::find()->orderBy('id ASC')->all(),'id','url');


?>
<div class = "col-xs-3">
    <?php
    echo '<label class="control-label">'.Yii::t('app','Add Audio').'</label>';
    echo FileInput::widget([
        'name' => "AudioContent[{$seq_index}][filename]",
        'id' => 'audiocontent-'.$seq_index.'-filename',
        'options'=>[
            'accept'=>'audio/*',
            'multiple'=>false
        ],
        'pluginOptions' => [
            'uploadUrl' => '#',
            'overwriteInitial'=>false,
            'allowedFileExtensions'=>\app\components\ConfigHelper::getExtensionByName('allowedAudioExtensions'),
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
                <div class="form-group field-audiocontenteav-'.$seq_index.'-'.$lang_key.'-title">';
                    echo '<label class="control-label" for="audiocontenteav-'.$seq_index.'-'.$lang_key.'-title">'.Yii::t('app','Audio title '.$lang).'</label>';
                    echo \yii\bootstrap\Html::input('text','AudioContentEav['.$seq_index.']['.$lang_key.'][title]','',['class'=>"form-control"]);
                echo '</div>';
                echo '<div class="form-group field-audiocontenteav-'.$seq_index.'-'.$lang_key.'-description">';
                    echo '<label class="control-label" for="audiocontenteav-'.$seq_index.'-'.$lang_key.'-description">'.Yii::t('app','Audio description '.$lang).'</label>';
                    echo \yii\bootstrap\Html::textarea('AudioContentEav['.$seq_index.']['.$lang_key.'][description]','',['class'=>"form-control"]);
                echo '</div>';
        echo '</div>';
    }
    ?>
    </div>
</div>
<div class="clearfix"></div>
