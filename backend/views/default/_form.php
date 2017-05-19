<?php

use yii\helpers\Html;
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;

$this->title = Yii::t('app',$type);
$this->params['breadcrumbs'][] = ['label' => 'Calendar', 'url' => ['calendar-entity']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="entity-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date', [
            'addon'=>['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
            'options'=>['class'=>'drp-container form-group'],
        ])->widget(DateRangePicker::classname(), [
            'useWithAddon'=>true,
            'pluginOptions'=>[
                'singleDatePicker'=>true,
                'showDropdowns'=>true,
                'locale'=>['format' => 'D-M-Y'],
            ]
        ]);
    ?>

    <?= $form->field($model, 'entity_id')->dropDownList($entity) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
