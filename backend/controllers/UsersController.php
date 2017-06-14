<?php

namespace backend\controllers;

use backend\models\NewsSearch;
use backend\models\UsersSearch;
use common\models\News;
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
}
