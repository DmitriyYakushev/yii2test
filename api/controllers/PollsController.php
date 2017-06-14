<?php
namespace api\controllers;



use common\models\Polls;
use yii\data\ActiveDataProvider;

class PollsController extends BaseController
{

	
	public $modelClass = 'common\models\Polls';
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
		$query = Polls::find();
		$query->andWhere(['poll_status'=>Polls::POLL_ACTIVE]);
		
		$dataProvider = new ActiveDataProvider( [
				'query' => $query,
				//'sort'=> ['defaultOrder' => ['forum_id'=>SORT_DESC]]
		] );
		
		return $dataProvider;
	}

}
