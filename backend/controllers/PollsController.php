<?php

namespace backend\controllers;

use backend\models\PollsSearch;
use common\models\Polls;
use common\models\PollsAnswers;
use Yii;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class PollsController extends BaseController
{
    public function actionIndex()
    {
        $model    = new PollsSearch();
        $provider = $model->search(Yii::$app->request->queryParams);
        return $this->render('index', compact('model', 'provider'));
    }

    public function actionUpdate($id = null)
    {
        $model = is_null($id) ? new Polls() : Polls::findOne(['poll_id' => $id]);
        $model->setScenario(Polls::SCENARIO_ADMIN_SAVE);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Poll ' . (is_null($id) ? 'added' : 'update') . ' success!');
                return $this->redirect(['polls/update', 'id' => $model->poll_id]);
            } else {
                Yii::$app->getSession()->setFlash('error', Html::errorSummary($model));
            }
        }
        return $this->render('update', ['model' => $model, 'emptyAnswer' => new PollsAnswers()]);
    }

    public function actionUpdateAnswer($id = null)
    {
        $model = is_null($id) ? new PollsAnswers() : PollsAnswers::findOne(['poll_answer_id' => $id]);

        if ($model->load(Yii::$app->request->post())) {

            if (empty($model->poll)) {
                throw new NotFoundHttpException('Poll not found');
            }

            if ($model->save()) {
                if (is_null($id) && ($model->poll->poll_status == Polls::POLL_PENDING)) {
                    $model->poll->poll_status = Polls::POLL_ACTIVE;
                    $model->poll->save(); //run filter with checking count ...
                }
                Yii::$app->getSession()->setFlash('success', 'Answer ' . (is_null($id) ? 'added' : 'update') . ' success!');
                return $this->redirect(['polls/update', 'id' => $model->poll_id]);
            } else {
                Yii::$app->getSession()->setFlash('error', Html::errorSummary($model));
                return $this->render('update', ['model' => $model->poll, 'emptyAnswer' => new PollsAnswers(), 'editedAnswer' => $model]);
            }
        }

        return $this->redirect(['polls/index']);
    }
}
