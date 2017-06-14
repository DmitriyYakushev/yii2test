<?php

namespace common\models;

class Events extends \common\models\generated\Events
{
    const API_SCENARIO_CREATE = "create";
    const API_SCENARIO_UPDATE = "update";

    public function rules()
    {
        return array_merge([
            [['event_start', 'event_end'], 'filter', 'filter' => function ($value) {
                $dt = \DateTime::createFromFormat('d M Y H:i', $value);
                return $dt ? $dt->getTimestamp() : null;
            }],
            ['event_image', 'url'],
        ], parent::rules());
    }

    public function scenarios()
    {
        $scenarion = parent::scenarios();
        //$scenarion[self::API_SCENARIO_UPDATE]=['forum_title','forum_text','category_id'];

        return $scenarion;
    }

    public function fields()
    {
        $fields = parent::fields();
        //$fields=['event_id','category'];
        $fields[] = 'category';
        return $fields;
    }

    public function extraFields()
    {
        return [];
    }
}
