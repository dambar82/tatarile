<?php

namespace app\backend;

/**
 * backend module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\backend\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 	'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }
}
