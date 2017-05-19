<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\backend\models\Subject */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$lang = \yii\helpers\ArrayHelper::index(\app\models\Lang::find()->all(), 'id');
$prop_name = \yii\helpers\ArrayHelper::index(\app\backend\models\SubjectProperty::find()->all(), 'id');
?>
<div class="subject-view">

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
            [
                'attribute' => 'date_create',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'date_update',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'author',
                'value' => $model->getUserName(),
            ],
        ],
    ]) ?>

    <h4><?= Yii::t('app','Subject Properties')?></h4>

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
                            <th>Свойство</th>
                            <th>Значение</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($properties[$language->id] as $prop) {
                            echo '<tr>
                                    <td>'.Yii::t('app',$prop_name[$prop->property_id]->title).'</td>
                                    <td>'.$prop->value.'</td>
                                  </tr>';
                        }
                        //print_r($properties[$language->id]);
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
