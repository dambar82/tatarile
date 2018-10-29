<?php

namespace app\widgets\widgets2018\LanguageWidget;

use app\models\Lang;

class LanguageWidget extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        return $this->render('index', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->orderBy('id DESC')->all(),
        ]);
    }
}
