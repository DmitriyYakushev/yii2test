<?php
namespace api\controllers;

use common\models\Events;
use Yii;
use yii\data\ActiveDataProvider;

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

}
