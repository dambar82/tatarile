<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\backend\models\SubjectPropertySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subject Properties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-property-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Subject Property', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute'=>'type_id',
                'label'=>Yii::t('app', 'Type ID'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->getTypeName();
                },
            ],
            [
                'attribute'=>'view',
                'format'=>'text',
                'content'=> function($data) {
                    if ($data->view==1) {return 'Значение по умолчанию';} else {return '';}
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
