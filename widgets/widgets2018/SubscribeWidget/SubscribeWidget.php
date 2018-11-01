<?php

namespace app\widgets\widgets2018\SubscribeWidget;

use app\backend\models\Entity;
use app\models\SubscribeEmail;
use yii\base\DynamicModel;
use yii\base\Widget;

class SubscribeWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = new SubscribeEmail();

        return $this->render('index', [
            'model' => $model
        ]);
    }
}