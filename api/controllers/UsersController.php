<?php
namespace api\controllers;

use api\models\Login;
use Yii;
use common\models\UsersTokens;
use common\models\Users;
use yii\data\ActiveDataProvider;
use yii\db\Query;


class UsersController extends BaseController
{
	public $modelClass = 'common\models\Users';
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
		$query = Users::find();
		$filter = Yii::$app->request->get('filter');
		switch($filter) {
			case 'follow':
				$query->joinWith(['follow']);
				$query->andFilterWhere(['follow_status'=>1]);
			break;
			case "nearme":
				$region=Yii::$app->request->get('region');
				if(is_array($region)) {
				//var_dump($region);
				//exit();
					$query->andFilterWhere(['>','user_lat',$region['center']['lat']-$region['span']['lat']]);
					$query->andFilterWhere(['<','user_lat',$region['center']['lat']+$region['span']['lat']]);
					$query->andFilterWhere(['>','user_long',$region['center']['long']-$region['span']['long']]);
					$query->andFilterWhere(['<','user_long',$region['center']['long']+$region['span']['long']]);
					$query->andFilterWhere(['<>','user_lat',0]);
					$query->andFilterWhere(['<>','user_long',0]);
					$query->andFilterWhere(['user_hide_location'=>0]);
				}
			break;
		}
		$search=Yii::$app->request->get('search');
		$query->andFilterWhere(['or',
				['like','user_fname',$search],
				['like','user_lname',$search],
				['like','user_occupation',$search],
				['like','user_company',$search],
				
		]);
	
		$dataProvider = new ActiveDataProvider( [
				'query' => $query,
//				'sort'=> ['defaultOrder' => ['forum_id'=>SORT_DESC]]
		] );
	
		return $dataProvider;
	}
	public function actionView($id) {
		$user=Users::findOne($id);
		return $user;
	}
	public function actionLogin() {
		$params=Yii::$app->request->post();
		$model = new Login();
		$model->login=Yii::$app->request->post('login');
		$model->password=Yii::$app->request->post('password');
		if(($user=$model->login())) {
			$device_id=Yii::$app->request->headers->get('device-id');
			$token=UsersTokens::findOne(['user_id'=>$user->user_id,'device_id'=>$device_id]);
			if(!$token) {
				$token=new UsersTokens();
			}
			$token->user_id=$user->user_id;
			$token->time=time();
			$token->token= hash ( 'sha512',  uniqid ( '', true ) );
			$token->device_id=$headers = $device_id;
			$token->save();
			return $token;
		}
		return $model;
	}
	public function actionMe() {
		$user=Users::findOne(Yii::$app->user->id);
		return $user;
	}
	public function actionUpdate() {
		$user=$this->actionMe();
		$user->scenario = Users::API_SCENARIO_UPDATE;
		$user->load(Yii::$app->request->post(),'');
		$user->save();
		return $user;
	}
	public function actionRegistration() {
		$params=Yii::$app->request->post();
		$user=new Users();
		$user->load($params,'');
		$user->user_status=Users::USER_STATUS_ACTIVE;
		$user->user_created=time();
		$user->user_updated=time();
		$user->save();
		return $user;
	}
	public function actionRestorePassword() {
		$email=Yii::$app->request->post('email',false);
		if($email) {
			$user=Users::findOne(['user_login'=>$email]);
			if($user) { 
				$ret=\Yii::$app->getModule('restore')->restorePassword($user->user_id);
				Yii::$app->PinxterMail->saveMailTemaplte($email, 186, ['username'=>$user->getFullname(),'restoreLink'=>('https://cmo-template.pinxterapp.com/api/restore/password?restore_token='.$ret->restore_token)]);
				return [];
			}
		}
		Yii::$app->response->statusCode = 422;
		Yii::$app->response->statusText='Data validation failed';
		return ['field'=>'email','message'=>'Email doesn\'t exist'];
	}
	public function actionValidateLogin() {
		$user=new Users();
		$user->user_login=Yii::$app->request->post('user_login');
		$user->validate(['user_login']);
		if(!$user->hasErrors()) {
			return [];
		}
		return $user;
		
	}
	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['authenticator']['except']=['login','registration','restore-password','validate-login'];
		return $behaviors;
	}
}
