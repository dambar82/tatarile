<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\backend\models\EntityProperty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-property-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\backend\models\PropertyType::find()->all(),'id','title')) ?>

    <?= $form->field($model, 'view')->dropDownList([
        '0' => 'Стандартное свойство',
        '1' => 'Значение по умолчанию',
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entity_type_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\backend\models\EntityType::find()->all(),'id','entity_type')) ?>

    <small>"Значение" по умолчанию - это Заголовок статьи, во всех остальных случаях применять "Стандартное значение"</small>
    <hr>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
