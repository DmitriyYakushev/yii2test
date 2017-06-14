<?php

namespace common\models;

class EventCategories extends \common\models\generated\EventCategories
{
	const API_SCENARIO_CREATE = "create";
	const API_SCENARIO_UPDATE = "update";
	
	
	public function scenarios()
	{	
		$scenarion=parent::scenarios();
		//$scenarion[self::API_SCENARIO_UPDATE]=['user_name','user_logo','user_password','user_company'];

		return $scenarion;
	}
	public function fields() {
		$fields = parent::fields ();
		return $fields;
	}

}
