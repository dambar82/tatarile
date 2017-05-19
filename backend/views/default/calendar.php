<?php
use yii\helpers\Html;

$this->title = 'Материал дня';
$this->params['breadcrumbs'][] = ['label' => 'Calendar', 'url' => ['calendar-entity']];
?>

<p>
    <?= Html::a(Yii::t('app','Добавить статью дня'), ["create?id=article"], ['class' => 'btn btn-success']) ?>
    <?= Html::a(Yii::t('app','Добавить мультимедиа дня'), ["create?id=multimedia"], ['class' => 'btn btn-success']) ?>
</p>

<div class="calendar-index" style="display: inline-block;">
    <div class="col-md-offset-3 col-md-6 col-xs-12">
        <?= yii2fullcalendar\yii2fullcalendar::widget([
            'options' => [
                'lang' => 'ru',
            ],
            'events' => $events,
        ]);
        ?>
    </div>
</div>
