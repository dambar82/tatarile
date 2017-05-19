<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\backend\models\SubjectProperty */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Subject Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-property-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'type_id',
                'value' => $model->getTypeName(),
            ],
            'view',
        ],
    ]) ?>

</div>
