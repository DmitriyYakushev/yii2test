<?php
namespace api\controllers;

use common\models\generated\News;
use yii\data\ActiveDataProvider;

class NewsController extends BaseController
{
    public $modelClass = 'common\models\generated\News';

    public function actions() {
        return [];
    }

    public function actionIndex() {
        $query = News::find();

        $dataProvider = new ActiveDataProvider( [
            'query' => $query,
        ] );

        return $dataProvider;
    }

    protected function verbs()
    {
        return [
            'index' => ['GET'],
        ];
    }
}