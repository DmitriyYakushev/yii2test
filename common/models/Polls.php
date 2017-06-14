<?php

namespace common\models;

/**
 * Class Polls
 * @package common\models
 *
 * @var PollsAnswers[] $answersIdDesc
 */
class Polls extends \common\models\generated\Polls
{
    const API_SCENARIO_CREATE = "create";
    const API_SCENARIO_UPDATE = "update";
    const SCENARIO_ADMIN_SAVE = "admin_save";

    const POLL_DELETED = 0;
    const POLL_ACTIVE  = 1;
    const POLL_PENDING = 2;

    public static function getPollStatuses()
    {
        return [
            self::POLL_ACTIVE  => 'Active',
            self::POLL_DELETED => 'Deleted',
            self::POLL_PENDING => 'Pendig',
        ];
    }

    public $feed_type;
    public $vote = 0;

    public function scenarios()
    {
        $scenarion = parent::scenarios();
        //$scenarion[self::API_SCENARIO_UPDATE]=['forum_title','forum_text','category_id'];

        return $scenarion;
    }

    public function rules()
    {
        return array_merge([
            [['poll_status'], 'in', 'range' => [self::POLL_ACTIVE, self::POLL_DELETED, self::POLL_PENDING]],
            [['poll_date'], 'filter', 'on' => self::SCENARIO_ADMIN_SAVE, 'filter' => function ($value) {
                $dt = \DateTime::createFromFormat('d M Y H:i', $value);
                return $dt ? $dt->getTimestamp() : null;
            }],
            ['poll_status', 'filter', 'filter' => function ($value) {
                if (($value == self::POLL_ACTIVE) && ($this->getPollsAnswers()->count() < 2)) {
                    return self::POLL_PENDING;
                }
                return $value;
            }],
        ], parent::rules());
    }

    public function fields()
    {
        $fields   = parent::fields();
        $fields[] = 'user';
        $fields[] = 'pollsAnswers';
        $fields[] = 'feed_type';
        $fields[] = 'vote';
        return $fields;
    }

    public function extraFields()
    {
        return [];
    }

    public function afterFind()
    {
        $vote = PollsHistory::findOne(['poll_id' => $this->poll_id, 'user_id' => \Yii::$app->user->id]);
        if ($vote) {
            $this->vote = 1;
        }
        return parent::afterFind();
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    public function getAnswersIdDesc()
    {
        return parent::getPollsAnswers()->orderBy(['poll_answer_id' => SORT_DESC]);
    }
}
