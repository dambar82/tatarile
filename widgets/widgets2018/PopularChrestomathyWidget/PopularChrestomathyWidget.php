<?php

namespace app\widgets\widgets2018\PopularChrestomathyWidget;

use app\models\chrestomathy\ChrestomathyEntity;
use yii\base\Widget;

class PopularChrestomathyWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        global $config;
        $config['params']['entity_type_for_eav'] = 'article';

        $entities = ChrestomathyEntity::find()
            ->where(['status' => 1, 'popular' => 1])
            ->innerJoinWith(['eav', 'category.eav'])
            ->limit(6)
            ->all();

        return $this->render('index', [
            'entities' => $entities
        ]);
    }
}