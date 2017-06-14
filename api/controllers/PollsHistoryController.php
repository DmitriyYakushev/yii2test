<?php
namespace api\controllers;



use common\models\Polls;
use yii\data\ActiveDataProvider;
use common\models\PollsHistory;
use common\models\PollsAnswers;

class PollsHistoryController extends BaseController
{

	
	public $modelClass = 'common\models\PollsHistory';
	public function actions() {
		$act = parent::actions();
		$actions=[];
		/*$actions['index']=$act['index'];
		$actions ['index'] ['prepareDataProvider'] = [
				$this,
				'prepareDataProvider'
		];*/
		//$actions['view']=$act['view'];
		return $actions;
	}
	/*public function prepareDataProvider() {
		$query = Polls::find();
		$query->andWhere(['poll_status'=>Polls::POLL_ACTIVE]);
		
		$dataProvider = new ActiveDataProvider( [
				'query' => $query,
				//'sort'=> ['defaultOrder' => ['forum_id'=>SORT_DESC]]
		] );
		
		return $dataProvider;
	}*/
	public function actionCreate() {
		$pollHistory=new PollsHistory();
		$pollHistory->loadDefaultValues();
		$pollHistory->load(\Yii::$app->request->post(),'');
		$pollHistory->user_id=\Yii::$app->user->id;
		$pollHistory->validate(['poll_answer_id']);
		if(!$pollHistory->hasErrors()) {
			$poll_ans=PollsAnswers::findOne(['poll_answer_id'=>$pollHistory->poll_answer_id]);
			if($poll_ans) {
				$pollHistory->poll_id=$poll_ans->poll_id;
			}
		}
		$pollHistory->save();
		return $pollHistory;
	}	

}
