<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\backend\models\Subject */

$this->title = 'Update Subject: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subject-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_eav' => $model_eav,
    ]) ?>

</div>
