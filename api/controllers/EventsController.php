<?php
namespace api\controllers;

use common\models\Events;
use common\models\generated\UserEvents;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class EventsController extends BaseController
{
	public $modelClass = 'common\models\Events';
	public function actions() {
		$act = parent::actions();
		$actions=[];
		$actions['index']=$act['index'];
		$actions ['index'] ['prepareDataProvider'] = [
				$this,
				'prepareDataProvider'
		];
		$actions['view']=$act['view'];
		return $actions;
	}
	public function prepareDataProvider() {
		$query = Events::find();
		
		$category_id=Yii::$app->request->get('category_id');
		$query->andFilterWhere(['category_id'=>$category_id]);
		
		$from_timestamp=Yii::$app->request->get('from_timestamp');
		$to_timestamp=Yii::$app->request->get('to_timestamp');
		$query->andFilterWhere(['>=','event_start',$from_timestamp]);
		$query->andFilterWhere(['<=','event_start',$to_timestamp]);
		
		$dataProvider = new ActiveDataProvider( [
				'query' => $query,
				//'sort'=> ['defaultOrder' => ['forum_id'=>SORT_DESC]]
		] );
	
		return $dataProvider;
	}

	public function actionFavoritesCreate()
    {
        $result = [
            'success' => false
        ];
        $params = Yii::$app->request->post();
        try {
            $userEvent = new UserEvents();
            $userEvent->load($params,'');
            $userEvent->save();
            $result['message'] = $userEvent;
        } catch (\yii\base\Exception $ex) {
            $result['error_code'] = $ex->getCode();
        }

        return $result;
    }

    public function actionFavoritesDelete()
    {
        $params = Yii::$app->request->post();
        $userEvent = UserEvents::findOne($params);
        if ($userEvent) {
            $userEvent->delete();
        }

        return $userEvent;
    }

    public function verbs()
    {
        return ArrayHelper::merge(parent::verbs(),[
            'favorites-create' => ['POST'],
            'favorites-delete' => ['DELETE'],
        ]);
    }

}
