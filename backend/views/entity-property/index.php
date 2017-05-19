<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\backend\models\EntityPropertySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entity Properties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-property-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Entity Property', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
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
            'name',
            [
                'attribute'=>'entity_type_id',
                'format'=>'text',
                'content'=> function($data) {
                    return \app\backend\models\EntityType::find()->select('entity_type')->where(['id'=>$data->entity_type_id])->scalar();
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
