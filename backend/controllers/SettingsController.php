<?php

namespace backend\controllers;

use backend\models\NewsSearch;
use backend\models\SettingsSearch;
use backend\models\UsersSearch;
use common\models\News;
use Yii;
use yii\helpers\Html;

/**
 * Site controller
 */
class SettingsController extends BaseController
{
    public function actionIndex()
    {
        $model    = new SettingsSearch();
        $provider = $model->search(Yii::$app->request->queryParams);
        return $this->render('index', compact('model', 'provider'));
    }

    public function actionUpdate($name = null)
    {
        $model = is_null($name) ? new SettingsSearch() : SettingsSearch::findOne(['setting_name' => $name]);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'News ' . (is_null($name) ? 'added' : 'update') . ' success!');
                return $this->redirect(['settings/update', 'name' => $model->setting_name]);
            } else {
                Yii::$app->getSession()->setFlash('error', Html::errorSummary($model));
            }
        }
        return $this->render('update', ['model' => $model]);
    }

}
