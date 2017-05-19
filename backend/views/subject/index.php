<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\backend\models\SubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Subject', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => Yii::t('app','Title'),
                'content' => function($data) {
                    return $data->getDefaultProperty();
                }
            ],
            [
                'attribute'=>'date_create',
                'label'=>'Date Create',
                'format'=>'datetime',
            ],
            [
                'attribute'=>'date_update',
                'label'=>'Date Update',
                'format'=>'datetime',
            ],
            [
                'attribute'=>'author',
                'label'=>'Author',
                'format'=>'text',
                'content'=>function($data){
                    return $data->getUserName();
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
