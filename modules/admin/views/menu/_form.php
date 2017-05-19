<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\MenuGroup;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-group-form">
 
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?php
	$titles = MenuGroup::find()->where(['type' => 0])->all();
    $items = ArrayHelper::map($titles,'id','name');
    $params = [
        'prompt' => Yii::t('app', 'Not parent')
    ];
	?>
	<?= $form->field($model, 'type')->dropDownList($items,$params) ?>

    <?= $form->field($model, 'URL')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'position')->dropDownList([
			'backend' => Yii::t('app', 'backend'),
			'frontend' => Yii::t('app', 'frontend'),
		]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
