<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\models\SubjectProperty */

$this->title = 'Create Subject Property';
$this->params['breadcrumbs'][] = ['label' => 'Subject Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-property-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
