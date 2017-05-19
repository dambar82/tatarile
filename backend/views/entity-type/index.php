<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entity Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-type-index">

    <p>
        <?= Html::a('Create Entity Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'entity_type',
            'class',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
