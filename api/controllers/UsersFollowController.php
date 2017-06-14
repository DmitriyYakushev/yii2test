<?php
namespace api\controllers;


use Yii;
use common\models\UsersFollow;
use yii\data\ActiveDataProvider;



class UsersFollowController extends BaseController
{
	public $modelClass = 'common\models\UsersFollow';
	public function actions() {
		$act = parent::actions();
		$actions=[];
		$actions['index']=$act['index'];
		$actions ['index'] ['prepareDataProvider'] = [
				$this,
				'prepareDataProvider'
		];
		return $actions;
	}
	public function prepareDataProvider() {
		$query = UsersFollow::find();
		//$query->leftJoin(['follow']);
		$query->andFilterWhere(['user_id'=>\Yii::$app->user->id]);
		$dataProvider = new ActiveDataProvider( [
				'query' => $query,
//				'sort'=> ['defaultOrder' => ['forum_id'=>SORT_DESC]]
		] );
	
		return $dataProvider;
	}
	public function actionView($id) {
		
		$userfollow=UsersFollow::findOne(['user_id'=>\Yii::$app->user->id,'follow_id'=>$id]);
		
		return $userfollow;
	}
	public function actionUpdate($id) {
		$userfollow=UsersFollow::findOne(['user_id'=>\Yii::$app->user->id,'follow_id'=>$id]);
		if(!$userfollow) {
			$userfollow=new UsersFollow();
			$userfollow->user_id=\Yii::$app->user->id;
			$userfollow->follow_id=$id;
			$userfollow->follow_status=0;	
		}
		$userfollow->scenario = UsersFollow::API_SCENARIO_UPDATE;
		$userfollow->load(Yii::$app->request->post(),'');
		$userfollow->save();
		return $userfollow;
	}
}
