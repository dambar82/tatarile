<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UserInfo */

$this->title = Yii::t('app', 'Update {modelClass} ', [
    'modelClass' => 'User Info',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cabinet'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-info-update">
    <div class="container">
        <div class="row user_inf">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
