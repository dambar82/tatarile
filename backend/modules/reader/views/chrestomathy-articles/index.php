<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Произведения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chrestomathy-articles-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'author',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
