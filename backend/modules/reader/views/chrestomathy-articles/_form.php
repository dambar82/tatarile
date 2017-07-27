<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\backend\modules\reader\models\ChrestomathyThemes;
use kartik\file\FileInput;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\backend\modules\reader\models\ChrestomathyArticles */
/* @var $form yii\widgets\ActiveForm */

$themes = ArrayHelper::map(ChrestomathyThemes::find()->all(),'id', 'title');

if ($model->image) {

}
?>

<div class="chrestomathy-articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'theme_id')->dropDownList($themes) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options'=>[
            'accept'=>'image/*',
            'multiple'=>false
        ],
        'pluginOptions' => [
            'initialPreview'=>$model->image ? '/files/chr/'.$model->image : '',
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>true,
            'showRemove' => false,
            'showUpload' => false,
        ]
    ]);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
