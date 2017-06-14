<?php


namespace common\models;

class UsersFollow extends \common\models\generated\UsersFollow
{
	const API_SCENARIO_CREATE = "create";
	const API_SCENARIO_UPDATE = "update";
	
	const FOLLOW=1;
	const UNFOLLOW=0;
	
	public function scenarios()
	{
		$scenarion=parent::scenarios();
		$scenarion[self::API_SCENARIO_UPDATE]=['follow_status','follow_note'];
		return $scenarion;
	}
	public function rules()
	{
		$rules=parent::rules();
		$rules[]=[['follow_status'],'in','range'=>[0,1]];
		return $rules;
	}
	public function fields() {
		$fields = parent::fields ();
		
		$fields=['follow_note','follow_id'];
		$fields['follow_status']=function ($model) {
			return (int) $model->follow_status;
		};
		return $fields;
	}
	
}