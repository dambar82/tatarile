<?php

use kartik\file\FileInput;

$upload_video_dir = Yii::getAlias("@web").'/files/video/';
$initialVideo = NULL;
if (!empty($model_video['filename'])) {
    $initialVideo = $upload_video_dir.$model_video['filename'];
}
?>
<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
<div class="col-xs-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-paragraph"></i> Видеофайл</h3>
        </div>
        <div class="panel-body content_body">
            <?= $form->field($model_video, "filename")->widget(FileInput::classname(), [
                'options'=>[
                    'multiple'=>false,
                    'accept'=>'video/*'
                ],
                'pluginOptions' => [
                    'initialPreview'=>[
                        $initialVideo,
                    ],
                    'initialPreviewAsData'=>true,
                    'initialPreviewFileType'=> 'video',
                    'initialPreviewConfig'=> [
                        ['filetype'=> "video/mp4"]
                    ],
                    'overwriteInitial'=>true,
                    'showRemove' => true,
                    'removeClass' => 'btn btn-danger',
                    'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
                    'showUpload' => false,
                    'maxFileSize'=>\app\components\ConfigHelper::getConfigByName('maxVideoSize'),
                    'allowedFileExtensions'=> \app\components\ConfigHelper::getExtensionByName('allowedVideoExtensions'),
                ],
            ]);
            ?>
        </div>
    </div>
</div>