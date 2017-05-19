<?php
use yii\helpers\Url;
?>

<div class="admin-default-index">

    <div class="row">
        <div class="col-xs-12 col-sm-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-cogs"></i>  Компоненты
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="<?=Url::to('/backend/entity-type/create')?>" class="list-group-item">
                            <i class="fa fa-plus"></i> Добавить
                            <span class="pull-right text-muted small"><em>Добавление компонента</em></span>
                        </a>
                        <a href="<?=Url::to('/backend/entity-type/index')?>" class="list-group-item">
                            <i class="fa fa-list"></i> Просмотр
                            <span class="pull-right text-muted small"><em>Просмотр компонентов</em></span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xs-12 col-sm-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-wrench"></i>  Конфигурация
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?=\yii\widgets\ListView::widget([
                            'dataProvider' => $configProvider,
                            'itemView' => '_config_item',
                            'layout' => '{items}',
                        ]);
                        ?>
                    </div>
                    <a href="<?=\yii\helpers\Url::to('/admin/config/create')?>" class="btn btn-default btn-block">Добавить настройку</a>
                </div>
            </div>

        </div>

        <div class="col-xs-12 col-sm-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-html5"></i>  Настройка SEO
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="<?=Url::to('/admin/seo/update-robots')?>" class="list-group-item">
                            <i class="fa fa-file-text-o"></i> Robots.txt
                            <span class="pull-right text-muted small"><em>Редактирование robots.txt</em></span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
