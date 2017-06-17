<?php

namespace backend\controllers;

use backend\models\NewsSearch;
use common\models\generated\News;
use Yii;
use yii\helpers\Html;

/**
 * Site controller
 */
class NewsController extends BaseController
{
    public function actionIndex()
    {
        $model = new NewsSearch();
        $provider = $model->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('model', 'provider'));
    }

    public function actionUpdate($id = null)
    {
        if ($id === null) {
            $model = new News();
        } else {
            $model = News::findOne(['news_id' => $id]);
        }

        $post = $model->load(Yii::$app->request->post());

        if ($post) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'News ' . ($id === null ? 'added' : 'update') . ' success!');
                return $this->redirect(['news/update', 'id' => $model->news_id]);
            } else {
                Yii::$app->getSession()->setFlash('error', Html::errorSummary($model));
            }
        }
        return $this->render('update', ['model' => $model]);
    }

}