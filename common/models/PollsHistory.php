<?php

namespace common\models;

use common\models\PollsAnswers;

class PollsHistory extends \common\models\generated\PollsHistory
{
	const API_SCENARIO_CREATE = "create";
	const API_SCENARIO_UPDATE = "update";
	

	public function scenarios()
	{	
		$scenarion=parent::scenarios();
		//$scenarion[self::API_SCENARIO_UPDATE]=['forum_title','forum_text','category_id'];

		return $scenarion;
	}

	public function fields() {
		$fields = parent::fields ();
		//$fields[]='user';
		//$fields[]='pollsAnswers';
		return $fields;
	}
	public function extraFields() {
		return [];
	}
	public function afterSave($insert, $changedAttributes) {
		if($insert) {
			PollsAnswers::updateAllCounters(['poll_answer_count'=>1],['poll_answer_id'=>$this->poll_answer_id]);
		}
		return parent::afterSave($insert, $changedAttributes);
	}
}
