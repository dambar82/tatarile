<?php

namespace app\modules\chrestomathy;

/**
 * chrestomathy module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\chrestomathy\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->layout = '@app/modules/chrestomathy/layouts/main';
    }
}
