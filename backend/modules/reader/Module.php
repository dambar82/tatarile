<?php

namespace app\backend\modules\reader;

/**
 * reader module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\backend\modules\reader\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->layout = '@app/backend/modules/reader/layouts/main';
    }
}
