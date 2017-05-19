<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menu Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-group-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Menu Group'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
			[
				'attribute'=>'type',
				'label'=>Yii::t('app', 'menuType'),
				'format'=>'text',
				'content'=>function($data){
					return $data->getParentName();
				},
			],

            'URL:url',
            'position',
			
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
