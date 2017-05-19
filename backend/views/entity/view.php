<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\backend\models\Entity */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Entities_'.$model->entity_type_id), 'url' => ['index?id='.$model->entity_type_id]];
$this->params['breadcrumbs'][] = $this->title;

$lang = \yii\helpers\ArrayHelper::index(\app\models\Lang::find()->all(), 'id');
$prop_name = \yii\helpers\ArrayHelper::index(\app\backend\models\EntityProperty::find()->asArray()->all(), 'id');

?>
<div class="article-view">

    <p>
        <?= Html::a('<i class="fa fa-list"></i> '.Yii::t('app','View list_'.$model->entity_type_id), \yii\helpers\Url::to('/backend/entity/index?id='.$model->entity_type_id), ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-eye"></i> '.Yii::t('app','View'), \app\components\UrlHelper::createEntityUrl($model->id), ['class' => 'btn btn-info','target' => '_blank']) ?>
        <?= Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app','Update_1'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash"></i> '.Yii::t('app','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'date_create:datetime',
            'date_update:datetime',
            [
                'label' => Yii::t('app','Status'),
                'format' => 'html',
                'value'=>$model->status == 1 ? '<span class="label label-success">Активен</span>' : '<span class="label label-danger">Не активен</span>'
            ],
        ],
    ]) ?>


    <h4><?= Yii::t('app','Entity Properties')?></h4>

    <ul class="nav nav-tabs">
        <?php
        $active = 'active';
        foreach ($lang as $key => $language) {
            echo '<li class="'.$active.'"><a data-toggle="tab" href="#panel_'.$language->url.'">'.$language->name.'</a></li>';
            $active ='';
        }
        ?>
    </ul>
    <div class="tab-content">
        <?php
        $active = 'in active';
        foreach ($lang as $key => $language) {
            ?>
            <div id="panel_<?=$language->url ?>" class="tab-pane fade <?=$active ?>">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th><?= Yii::t('app','Property')?></th>
                        <th><?= Yii::t('app','Value')?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($properties))
                    {
                        foreach ($properties[$language->id] as $prop) {
                            echo '<tr>
                                    <td>'.Yii::t('app',$prop_name[$prop->property_id]['title']).'</td>
                                    <td>'.$prop->value.'</td>
                                  </tr>';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            $active = '';
        }
        ?>
    </div>
</div>
