<?php

$params = require(__DIR__ . '/../../common/config/params.php');
$db = require(__DIR__ . '/../../common/config/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'users/index',
    'controllerNamespace' => 'frontend\controllers',
	'language' => 'en-US',
		
	// set source language to be English
	'sourceLanguage' => 'en-US',
    'components' => array_merge(require __DIR__ . '/../../common/config/db.php', [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'M0IP4s3PWhq1eZPFuuAwBzB11HD87mazCffbbChB',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\models\Users',
            'enableAutoLogin' => true,
        ],
    	'session' => [
    		'name' => 'bla-frontend',
    	],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'upload' => [
            'class'=>'yii\pinxter\PinxterUpload',
            'storage_id' => '12',
            'storage_secret' => 'pmSOz9yxuXO1zly',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            	'/'=>'site/index',
            ],
        ],
        
    ]),
    'params' => $params,
];

return $config;
