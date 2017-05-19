<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\backend\models\Entity */

$this->title = Yii::t('app','Update Entity') . ' : ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Entities'), 'url' => ['index?id='.$model->entity_type_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="article-update">
    <?php

    if ($model->entity_type_id ==1) {
        echo $this->render('_form',
            [
                'model' => $model,
                'model_eav' => $model_eav,
                'model_content'=>$model_content,
                'model_image_eav' => $model_image_eav,
                'date_model' => $date_model,
                'model_related' => $model_related,
            ]
        );
    }

    if ($model->entity_type_id ==2) {
        echo $this->render('_form',
            [
                'model' => $model,
                'model_eav' => $model_eav,
                'model_video' => $model_video,
                'model_pdf' => $model_pdf,
                'date_model' => $date_model,
                'model_related' => $model_related,
            ]
        );
    }

    if ($model->entity_type_id ==4) {
        echo $this->render('_form',
            [
                'model' => $model,
                'model_eav' => $model_eav,
                'model_video' => $model_video,
                'model_pdf' => $model_pdf,
                'date_model' => $date_model,
                'model_related' => $model_related,
            ]
        );
    }
    ?>


</div>
