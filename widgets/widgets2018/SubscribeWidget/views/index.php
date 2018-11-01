<?php
/* @var $model \app\models\SubscribeEmail */
/* @var $this \yii\web\View */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(['options' => ['class' => 'form-subscribe']]); ?>

    <?= $form->field($model, 'email', [
            'options' => ['class' => 'form--groud'],
            'template' => "{label}\n{input}",
            'labelOptions' => ['class' => 'form--label']
    ])->input('email', [
            'class' => "form--item",
            "placeholder" => Yii::t("app", "Ваша электронная почта")
    ])->label(Yii::t('app','Получать периодическую рассылку об обновлении сайта')) ?>

    <div class="form-actions">
        <?= Html::submitButton(Yii::t('app','Subscribe'), ['class' => 'btn form--submit']) ?>
    </div>

<?php ActiveForm::end() ?>

<?php
$script = <<< JS
    $('.form-subscribe').on('beforeSubmit', function() {
      var data = $(this).serialize();
      $.ajax({
            url: '/subscribe/index',
            type: 'POST',
            data: data,
            success: function(res){
                $('.block--subscribed').removeClass('hidden');
                $('#subscribeemail-email').val('');
            }
      });
      return false;
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
