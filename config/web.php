<?php

$params = require(__DIR__ . '/params.php');
function x() {
    return "dasdasdasd";
}
$config = [
    'id' => 'basic',
	'language'=>'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'modules' => [
		'admin' => [
            'class' => 'app\modules\admin\Module',
			'layoutPath' => '@app/modules/admin/views/layouts',
			'layout' => 'main'
        ],
        'file' => [
            'class' => 'app\modules\file\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
            'defaultRoute' => 'cabinet/index',
        ],
        'backend' => [
            'class' => 'app\backend\Module',
            'layoutPath' => '@app/modules/admin/views/layouts',
            'layout' => 'main'
        ],
		'user-management' => [
			'class' => 'webvimark\modules\UserManagement\UserManagementModule',
			'layoutPath' => '@app/modules/admin/views/layouts',
			'layout' => 'main',
			'enableRegistration' => true,
			'on beforeAction'=>function(yii\base\ActionEvent $event) {
                if ( $event->action->uniqueId == 'user-management/auth/login' )
                {
                    $event->action->controller->layout = '@vendor/webvimark/module-user-management/views/layouts/loginLayout.php';
                };
                if ( $event->action->uniqueId == 'user-management/auth/registration' )
                {
                    $event->action->controller->layout = '@app/views/layouts/main.php';
                };
            },
		],
    ],
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true
        ],
        'request' => [
            'cookieValidationKey' => 'DSFgksdifhiw899734hekfDFGisjdfi9374',
            'class' => 'app\components\LangRequest'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
			'class' => 'webvimark\modules\UserManagement\components\UserConfig',
			'on afterLogin' => function($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
		],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[
                'login' => 'user-management/auth/login',
                'register' => 'user-management/auth/registration',
                'logout' => 'user-management/auth/logout',
                'robots.txt' => 'site/robots',
                ['pattern' => 'robots', 'route' => 'site/robots', 'suffix' => '.txt'],

                'entity/product' => 'site/error',
                'entity/category' => 'site/error',

                [
                    'class'=>'app\components\EntityEncUrlManager'
                ],
                [
                    'class'=>'app\components\CategoryUrlManager'
                ],

                '<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
            ],
            'class'=>'app\components\LangUrlManager',
        ],
    ],
    'params' => $params,
];

if (file_exists(__DIR__ . '/db-local.php')){
    $config['components']['db'] = require(__DIR__ . '/db-local.php');
}

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1'],
    ];
}

return $config;