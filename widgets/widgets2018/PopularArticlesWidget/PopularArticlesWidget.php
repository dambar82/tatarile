<?php

namespace app\widgets\widgets2018\PopularArticlesWidget;

use app\backend\models\Entity;
use yii\base\Widget;

class PopularArticlesWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        global $config;
        $config['params']['entity_type_for_eav'] = 'article';

        $entities = Entity::find()
            ->where(['status' => 1, 'popular' => 1])
            ->innerJoinWith(['eav', 'category.eav'])
            ->limit(6)
            ->all();


        return $this->render('index', [
            'entities' => $entities
        ]);
    }
}