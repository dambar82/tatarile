<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\backend\models\EntitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_create') ?>

    <?= $form->field($model, 'date_update') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'user') ?>

    <?php // echo $form->field($model, 'corrector') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
