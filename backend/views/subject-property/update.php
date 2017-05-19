<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\backend\models\SubjectProperty */

$this->title = 'Update Subject Property: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Subject Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subject-property-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
