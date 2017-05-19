<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\backend\models\EntitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Entities');
$this->params['breadcrumbs'][] = $this->title;

$entity = \app\backend\models\EntityType::find()->select('entity_type')->where(['id' => $entity_type_id])->scalar();

?>
<div class="article-index">

    <p>
        <?= Html::a(Yii::t('app','Create Entity '. $entity), ["create?id=".$entity_type_id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'label' => 'Текст',
                'content'=>function($data){
                    if ($data->cor == 1) {
                        return '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i></span>';
                    }
                    else {
                        return '<span class="label label-danger"><i class="fa fa-times"></i></span>';
                    }
                },
            ],
            [
                'label' => 'Изображения',
                'content'=>function($data){
                    if ($data->image_cor == 1) {
                        return '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i></span>';
                    }
                    else {
                        return '<span class="label label-danger"><i class="fa fa-times"></i></span>';
                    }
                },
            ],
            [
                'label' => 'Общая готовность',
                'content'=>function($data){
                    if ($data->ready == 1) {
                        return '<span class="label label-success"><i class="glyphicon glyphicon-ok"></i></span>';
                    }
                    else {
                        return '<span class="label label-danger"><i class="fa fa-times"></i></span>';
                    }
                },
            ],
            [
                'label' => Yii::t('app','Status'),
                'content'=>function($data){
                    if ($data->status == 1) {
                        return '<span class="label label-success">Опубликован</span>';
                    }
                    else {
                        return '<span class="label label-danger">Не опубликован</span>';
                    }
                },
            ],
            [
                'label' => 'Просмотреть',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(
                        'Перейти',
                        \app\components\UrlHelper::createEntityUrl($data->id),
                        [
                            'title' => 'Показ на сайте!',
                            'target' => '_blank',
                            'class' => 'btn btn-default btn-xs'
                        ]
                    );
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
