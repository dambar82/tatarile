<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app','Contact');
?>
<div class="main_block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-lg-6 col-md-push-1 col-lg-push-3">
                <h1 class="title" id="page-title"><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="basic-page site-contact">
            <div class="row">
                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
                    <div class="col-md-offset-3 col-md-6">
                        <div class="alert alert-success">
                            Спасибо за обращение. Мы ответим Вам в ближайшее время!
                        </div>
                    </div>
                <?php else: ?>
                <div class="col-md-offset-3 col-md-6">

                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label(\Yii::t('app','YName')) ?>

                        <?= $form->field($model, 'email')->label(\Yii::t('app','Email')) ?>

                        <?= $form->field($model, 'subject')->label(\Yii::t('app','YSubject')) ?>

                        <?= $form->field($model, 'body')->textArea(['rows' => 6])->label(\Yii::t('app','Body')) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ])->label(\Yii::t('app','Verification Code')) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
