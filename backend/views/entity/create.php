<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\models\Entity */

$this->title = Yii::t('app','Create Entity_'.$model->entity_type_id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Entities'), 'url' => ['index?id='.$model->entity_type_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_eav' => $model_eav,
        'model_video' => $model_video,
        'model_pdf' => $model_pdf,
        'date_model' => $date_model,
        'model_related' => $model_related,
    ]) ?>

</div>
