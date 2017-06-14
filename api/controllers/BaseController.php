<?php

namespace api\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\filters\auth\QueryParamAuth;
use yii\pinxter\rest\RestParamAuth;

class BaseController extends ActiveController
{
     public function checkAccess($action, $model = null, $params = []) {
    /*    if($action=='view') {
    	    throw new ForbiddenHttpException;
        }
        print_r($action);
        print_r($model);
        print_r($params);
        exit();
        */
     }
     public function behaviors()
     {
		$behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
	    	'class' => RestParamAuth::className(),
        ];
        return $behaviors;
    }
}
