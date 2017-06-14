<?php

namespace common\models;

class Settings extends \common\models\generated\Settings
{
	const API_SCENARIO_CREATE = "create";
	const API_SCENARIO_UPDATE = "update";
	
	public $follow=0;
	public function scenarios()
	{	
		$scenarion=parent::scenarios();
		//$scenarion[self::API_SCENARIO_UPDATE]=['forum_title','forum_text','category_id'];

		return $scenarion;
	}
	public function fields() {
		$fields = parent::fields ();
		return $fields;
	}
	public function extraFields() {
		return [];
	}
	public function afterFind() {
		$ret=json_decode($this->setting_value);
		if($ret!==null) {
			$this->setting_value=$ret;
		}
	}
}
