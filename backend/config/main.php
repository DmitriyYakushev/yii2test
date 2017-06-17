<?php

Yii::setAlias('ext', dirname(__FILE__) . '/../extensions');

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

Yii::setAlias('@backend', dirname(__DIR__));

return [
    'id'                  => 'app-backend',
    'basePath'            => dirname(__DIR__),
    'name'                => 'Admin Panel',
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute'        => 'users/index',
    'components'          => array_merge(require __DIR__ . '/../../common/config/db.php', [
        'ih'           => [
            'class' => '\common\components\CImageHandler',
        ],
        'user'         => [
            'identityClass'   => 'backend\models\User',
            'enableAutoLogin' => true,
            'identityCookie'  => [
                'name' => '_backendUser',
                'path' => '/backend/web'
            ]
        ],
        'session'      => [
            'name' => '_backendSessionId1', // unique for backend
        ],
        'authManager'  => [
            'class'        => 'yii\rbac\PhpManager',
            'defaultRoles' => ['admin', 'manager', 'user'],
        ],
        'request'      => [
            'cookieValidationKey' => 'SDFAsdfajusdfn&&jsdfnjs_32ew_backend',
            'csrfParam'           => '_backendCSRF',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => []
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ]),
    'params'              => $params
];
