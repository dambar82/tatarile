<?php

namespace app\modules\admin;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */

    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->params['foo'] = 'bar';
        // custom initialization code goes here
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
