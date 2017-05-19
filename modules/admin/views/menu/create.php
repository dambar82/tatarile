<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MenuGroup */

$this->title = Yii::t('app', 'Create Menu Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
