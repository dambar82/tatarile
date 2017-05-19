<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\backend\models\EntityProperty */

$this->title = 'Update Entity Property: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Entity Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-property-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
