<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;

$labels = ArrayHelper::map(\app\models\Lang::find()->all(),'id','url');

/* @var $this yii\web\View */
/* @var $model app\backend\models\Subject */
/* @var $form yii\widgets\ActiveForm */

$s_prop = \app\backend\models\SubjectProperty::find()->all();
$property_type = ArrayHelper::map($s_prop,'id','type_id');
$property_name = ArrayHelper::map($s_prop,'id','title');

?>


<div class="subject-form">

    <?php $form = ActiveForm::begin([
        'id' => 'subject-form',
        'options' => [
            'enctype' => 'multipart/form-data'
        ],
    ]); ?>


<div class="clearfix"></div>
    <?php
    foreach ($model_eav as $i=>$value) {
        foreach ($value as $j=>$val) {
            switch ($property_type[$val->property_id]) {
                case 1:
                    echo $form->field($val, "[$j][$i]value")->textInput()->label(Yii::t('app',$property_name[$val->property_id].'_'.$labels[$val->lang_id]));
                    break;
                case 2:
                    echo $form->field($val, "[$j][$i]value")->widget(Widget::className(), [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 200,
                            'plugins' => [
                                'clips',
                                'fullscreen'
                            ]
                        ]
                    ])->label(Yii::t('app',$property_name[$val->property_id].'_'.$labels[$val->lang_id]));
                    break;
            }
        }
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
