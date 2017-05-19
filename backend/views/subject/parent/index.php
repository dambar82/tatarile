<?php

use yii\helpers\Html;

$this->title = 'Темы';
$this->params['breadcrumbs'][] = $this->title;

$main_index = 0;
?>

<p>
    <?= Html::a('Создать тему', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="subjects">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>№</th>
                <th>Название темы</th>
                <th>Фильтр дат</th>
                <th>Фон</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subjects as $subject): ?>
                <?php
                    $main_sub = $subject['subject'];
                    $main_index++;
                ?>
                <tr>
                    <td>
                        <?=$main_index?>
                    </td>
                    <td>
                        <b><?php echo \app\components\GetSubject::getSubjectTitle($main_sub->id);?></b>
                        <?php  if (!empty($subject['subsubject'])) :?>
                            <table class="table table-striped" style="background-color: azure;">
                                <?php foreach ($subject['subsubject'] as $subsubject): ?>
                                    <tr>
                                        <td> - <?php echo \app\components\GetSubject::getSubjectTitle($subsubject->id);?></td>
                                        <td>
                                            <a href="<?=\yii\helpers\Url::to('/backend/subject/update_sub?id='.$subsubject->id)?>"><i class="fa fa-pencil"></i></a>
                                            <?= Html::a('<i class="fa fa-trash-o"></i>', ['delete', 'id' => $subsubject->id], [
                                                'class' => 'label label-default',
                                                'style' => 'margin-left: 15px;',
                                                'data' => [
                                                    'confirm' => 'Удалить?',
                                                    'method' => 'post',
                                                ],
                                            ]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php endif; ?>

                        <div class="">
                            <?= Html::a('<i class="fa fa-plus"></i> Добавить подкатегории', ['add_sub', 'id' => $main_sub->id], ['class' => 'label label-default']) ?>


                        </div>
                    </td>
                    <td>
                        <?php
                        if ($main_sub->date_status == 0) {
                            echo '<span class="label label-warning">Не участвует</span>';
                        }
                        else {
                            echo '<span class="label label-success">Участвует</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (!empty($main_sub->filename)) {
                            echo '<img src="'.Yii::getAlias('@web').$main_sub->filename.'" style="width:80px;">';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="<?=\yii\helpers\Url::to('/backend/subject/update?id='.$main_sub->id)?>"><i class="fa fa-pencil-square-o"></i> Редактировать</a>
                        <?= \yii\helpers\Html::a('<i class="fa fa-trash-o"></i> Удалить', ['delete', 'id' => $main_sub->id], [
                            'class' => 'label label-danger',
                            'style' => 'margin-left: 15px;',
                            'data' => [
                                'confirm' => 'Удалить?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>