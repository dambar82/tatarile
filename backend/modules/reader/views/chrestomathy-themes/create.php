<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\modules\reader\models\ChrestomathyThemes */

$this->title = 'Добавить тему';
$this->params['breadcrumbs'][] = ['label' => 'Темы хрестоматии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chrestomathy-themes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
