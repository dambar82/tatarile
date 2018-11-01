<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests/codeception');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@webroot' => dirname(dirname(__FILE__)) . '/web',
        '@web' => '/web',
    ],
	'modules'=>[
		'user-management' => [
			'class' => 'webvimark\modules\UserManagement\UserManagementModule',
				'controllerNamespace'=>'vendor\webvimark\modules\UserManagement\controllers',
		],
	],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => [$params['adminEmail'] => $params['adminName']],
            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => $params['adminEmail'],
                'password' => '1982@cvlbcv',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'baseUrl' => '',
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
        'db' => $db,
    ],
    'params' => $params,

    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
        'schemadump' => [
            'class' => 'jamband\schemadump\SchemaDumpController',
        ],
    ],

];
if (file_exists(__DIR__ . '/db-local.php')){
    $config['components']['db'] = require(__DIR__ . '/db-local.php');
}
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
