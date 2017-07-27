<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\backend\modules\reader\models\ChrestomathyArticles */

$this->title = 'Редактировать: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Произведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="chrestomathy-articles-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
