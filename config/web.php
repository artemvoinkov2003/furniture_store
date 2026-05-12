<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'language' => 'ru',

    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'main',
        ],
    ],

    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',            
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'coursework',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',  
            'errorView' => '@app/views/site/error.php',
            'discardExistingOutput' => false,          
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        /*
        'smsRu' => [
            'class' => 'app\components\SMSRu',
            'api_id' => '11379540-C8C6-2A7E-5C44-213E4B7499D1', 
        ],*/
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => '/site/index',
                'catalog' => '/site/catalog',
                'about' => '/site/about',
                'ideas' => '/site/ideas',
                'basket' => '/site/basket',
                'contact' => '/site/contact',
                'register' => '/site/register',
                'login' => '/site/login',
                'authentication' => 'site/authentication',

                'pouf' => 'site/pouf',
                'chair' => 'site/chair',
                'shelving' => 'site/shelving',

                'favorites' => 'favorites/index',
                'favorites/add/<id:\d+>' => 'favorites/add',
                'favorites/remove/<id:\d+>' => 'favorites/remove',
                

                'basket/update' => 'basket/update',                
                'basket/update-quantity' => 'basket/update-quantity',    

                /*'admin' => '/admin/products/index', */
                
                'admin' => 'admin/products/index',
                'admin/<controller:\w+>/<action:\w+>' => 'admin/<controller>/<action>',
                'admin/<controller:\w+>/<action:\w+>/<id:\d+>' => 'admin/<controller>/<action>',
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
