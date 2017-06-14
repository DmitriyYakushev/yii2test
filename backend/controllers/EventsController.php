<?php

namespace backend\controllers;

use backend\models\EventsSearch;
use common\models\Events;
use Yii;
use yii\helpers\Html;

/**
 * Site controller
 */
class EventsController extends BaseController
{
    public function actionIndex()
    {
        $model    = new EventsSearch();
        $provider = $model->search(Yii::$app->request->queryParams);
        return $this->render('index', compact('model', 'provider'));
    }

    public function actionUpdate($id = null)
    {
        $model = $id === null ? new Events() : Events::findOne(['event_id' => $id]);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Event ' . ($id === null ? 'added' : 'update') . ' success!');
                return $this->redirect(['events/update', 'id' => $model->event_id]);
            } else {
                Yii::$app->getSession()->setFlash('error', Html::errorSummary($model));
            }
        }
        return $this->render('update', ['model' => $model]);
    }
}
