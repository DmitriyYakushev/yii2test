<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "polls_answers".
 *
 * @property integer $poll_answer_id
 * @property integer $poll_id
 * @property string $poll_answer
 * @property integer $poll_answer_count
 *
 * @property Polls $poll
 * @property PollsHistory[] $pollsHistories
 */
class PollsAnswers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'polls_answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poll_id', 'poll_answer'], 'required'],
            [['poll_id', 'poll_answer_count'], 'integer'],
            ['poll_answer_count', 'default', 'value' => 0],
            [['poll_answer'], 'string'],
            [['poll_id'], 'exist', 'skipOnError' => true, 'targetClass' => Polls::className(), 'targetAttribute' => ['poll_id' => 'poll_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'poll_answer_id'    => 'Poll Answer ID',
            'poll_id'           => 'Poll ID',
            'poll_answer'       => 'Poll Answer',
            'poll_answer_count' => 'Poll Answer Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoll()
    {
        return $this->hasOne(Polls::className(), ['poll_id' => 'poll_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollsHistories()
    {
        return $this->hasMany(PollsHistory::className(), ['poll_answer_id' => 'poll_answer_id']);
    }
}
