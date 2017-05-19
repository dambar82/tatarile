<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\models\EntityProperty */

$this->title = 'Create Entity Property';
$this->params['breadcrumbs'][] = ['label' => 'Entity Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-property-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
