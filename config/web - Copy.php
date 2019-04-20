<?php
date_default_timezone_set('America/Mexico_City');
require_once(__DIR__.'/debug.php');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	
	'defaultRoute' => 'dash',
    'components' => [
        'request' => [
            'cookieValidationKey' => '4I3DP78t0k_x-SiXfV0TwTFAx0mRa0lh',
               'baseUrl' => "/segerp",
		],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'dash/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mailer',
            'useFileTransport' => false,
            'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'moskiup@gmail.com',
            'password' => '',
            'port' => '587',
            'encryption' => 'tls',
                        ],
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
            'rules' => [
             
                'dashboard'=>'dash/index',
               

                'erp/cat/<controller:\w+>/<action:\w+>' =>  'cat<controller>/<action>',
                'cat/<controller:\w+>/' =>  'cat<controller>/index',
                '<controller:\w+>/<id:\d+>' => 'dash/<controller>/view',
               '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:dd/MM/Y',
            'datetimeFormat' => 'php:dd/MM/Y HH:mm:ss',
            'timeFormat' => 'php:H:i:s',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 2,
            ]
        ],
        
 ],

    'params' => $params,
];


$config['modules']['gridview']=['class' => '\kartik\grid\Module'];
$config['modules']['rbac'] =  ['class' => 'dektrium\rbac\Module'];
$config['modules']['rbac'] =  ['class' => 'dektrium\rbac\Module'];
$config['modules']['user'] = 
    ['class' => 'dektrium\user\Module',
    'enableUnconfirmedLogin' => true,
    'confirmWithin' => 21600,
    'cost' => 12,
    'admins' => ['moskito'],
    'enableRegistration'=>false,
        ];             

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ //here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'catalogos' => '@app/templates/crud/cats', // template name => path to template
                ]
            ],
            'model' => [ // generator name
                'class' => 'yii\gii\generators\model\Generator', // generator class
                'templates' => [ //setting for out templates
                    'modelBlame' => '@app/templates/models/cus', // template name => path to template
                ]
            ]
        ],
        
    ];

     
}

return $config;
