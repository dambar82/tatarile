<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuGroup */

$this->title = Yii::t('app', 'Menu Groups');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $model->name), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="menu-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
