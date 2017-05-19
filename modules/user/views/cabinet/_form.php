<?php

use yii\helpers\Html;

use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
/*use demi\cropper\Cropper;
use yii\web\JsExpression;*/


use app\assets\CabinetAsset;

CabinetAsset::register($this);

if (empty($model['file_name'])) {
    $model['file_name'] = 'default_user.png';
}
?>

<div class="user-info-form">

    <?php $form = ActiveForm::begin([
                        'id' => 'user-info-form',
                        'options' => [
                            'enctype' => 'multipart/form-data'
                         ],
    ]); ?>

    <?php echo $form->field($model, 'file_name')->widget(FileInput::classname(), [
        'options'=>[
            'multiple'=>false
        ],
        'pluginOptions' => [
            'initialPreview'=>[
                Yii::getAlias("@web/files/avatars/").$model['file_name'],
            ],
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>true,
            'showUpload' =>false,
            'maxFileSize'=>2800
        ],
    ]); ?>
    <?php /*echo $form->field($model, 'file_name')->widget(Cropper::classname(),[
    // If true - it's output button for toggle modal crop window
    'modal' => true,
    // You can customize modal window. Copy /vendor/demi/cropper/views/modal.php
    'modalView' => '@backend/views/image/custom_modal',
    // URL-address for the crop-handling request
    // By default, sent the following post-params: x, y, width, height, rotate
    'cropUrl' => ['cropImage', 'id' => $image->id],
    // Url-path to original image for cropping
    'image' => Yii::getAlias("@web/files/avatars/").$model['file_name'],
    // The aspect ratio for the area of cropping
    'aspectRatio' => 4 / 3, // or 16/9(wide) or 1/1(square) or any other ratio. Null - free ratio
    // Additional params for JS cropper plugin
    'pluginOptions' => [
        // All possible options: https://github.com/fengyuanchen/cropper/blob/master/README.md#options
        'minCropBoxWidth' => 400, // minimal crop area width
        'minCropBoxHeight' => 300, // minimal crop area height
    ],
    // HTML-options for widget container
    'options' => [],
    // HTML-options for cropper image tag
    'imageOptions' => [],
    // Additional ajax-options for send crop-request. See jQuery $.ajax() options
    'ajaxOptions' => [
        'success' => new JsExpression(<<<JS
            function(data) {
                // data - your JSON response from [[cropUrl]]
                $("#myImage").attr("src", data.croppedImageSrc);
            }
JS
        ),
    ],
]); */?>


    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday', [
        'addon'=>['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
        'options'=>['class'=>'drp-container form-group']
    ])->widget(DateRangePicker::classname(), [
      'useWithAddon'=>true,
      'pluginOptions'=>[
          'singleDatePicker'=>true,
          'showDropdowns'=>true,
          'locale'=>['format' => 'DD MMMM YYYY']
      ]
    ]);
?>

    <?= $form->field($model, 'school')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'school_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
//$this->registerJsFile(Yii::getAlias('@web/').'js/kladr/js/jquery.kladr.min.js');

$script = <<< JS

JS;
$this->registerJs($script, yii\web\View::POS_END);
?>
