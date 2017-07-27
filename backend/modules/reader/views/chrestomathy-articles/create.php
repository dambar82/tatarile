<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\modules\reader\models\ChrestomathyArticles */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Произведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chrestomathy-articles-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
