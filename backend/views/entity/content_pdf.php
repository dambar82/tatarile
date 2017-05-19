<?php

use kartik\file\FileInput;

$upload_pdf_dir = Yii::getAlias("@web").'/files/pdf/';
$initialPdf = NULL;
if (!empty($model_pdf['filename'])) {
    $initialPdf = $upload_pdf_dir.$model_pdf['filename'];
}
?>

<div class="col-xs-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-paragraph"></i> PDF-книги</h3>
        </div>
        <div class="panel-body content_body">
            <?= $form->field($model_pdf, "filename")->widget(FileInput::classname(), [
                'options'=>[
                    'multiple'=>false,
                    'accept'=>'application/pdf'
                ],
                'pluginOptions' => [
                    'initialPreview'=>[
                        $initialPdf,
                    ],
                    'initialPreviewAsData'=>true,
                    'initialPreviewFileType'=> 'pdf',
                    'overwriteInitial'=>true,
                    'showRemove' => true,
                    'removeClass' => 'btn btn-danger',
                    'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
                    'showUpload' => false,
                    'maxFileSize'=>\app\components\ConfigHelper::getConfigByName('maxPdfSize'),
                    'allowedFileExtensions'=> \app\components\ConfigHelper::getExtensionByName('allowedPdfExtensions'),
                ],
            ]);
            ?>
        </div>
    </div>
</div>