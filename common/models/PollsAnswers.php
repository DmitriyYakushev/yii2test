<?php

namespace common\models;

class PollsAnswers extends \common\models\generated\PollsAnswers
{
    const API_SCENARIO_CREATE = "create";
    const API_SCENARIO_UPDATE = "update";


    public function scenarios()
    {
        $scenarion = parent::scenarios();
        //$scenarion[self::API_SCENARIO_UPDATE]=['forum_title','forum_text','category_id'];

        return $scenarion;
    }

    public function fields()
    {
        $fields = parent::fields();
        //$fields[]='user';
        //$fields[]='pollsAnswers';
        return $fields;
    }

    public function extraFields()
    {
        return [];
    }

    public function getPoll()
    {
        return $this->hasOne(Polls::className(), ['poll_id' => 'poll_id']);
    }
}
