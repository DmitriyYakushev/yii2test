<?php

namespace backend\controllers;

use backend\models\UsersSearch;
use common\models\generated\Users;
use Yii;
use yii\helpers\Html;

/**
 * Site controller
 */
class UsersController extends BaseController
{
    public function actionIndex()
    {
        $model    = new UsersSearch();
        $provider = $model->search(Yii::$app->request->queryParams);
        return $this->render('index', compact('model', 'provider'));
    }

    public function actionViewEvents($userId)
    {
        $user = Users::findOne($userId);
        $model = $user->events;

        return $this->render('events', compact('model', 'user'));
    }
}
