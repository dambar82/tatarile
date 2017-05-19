<?php

namespace app\modules\file;

/**
 * file module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\file\controllers';

    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 	'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
