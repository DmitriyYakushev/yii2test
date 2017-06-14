<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "polls_history".
 *
 * @property integer $polls_history_id
 * @property integer $user_id
 * @property integer $poll_id
 * @property integer $poll_answer_id
 *
 * @property Users $user
 * @property Polls $poll
 * @property PollsAnswers $pollAnswer
 */
class PollsHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'polls_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'poll_id', 'poll_answer_id'], 'required'],
            [['user_id', 'poll_id', 'poll_answer_id'], 'integer'],
            [['user_id', 'poll_id'], 'unique', 'targetAttribute' => ['user_id', 'poll_id'], 'message' => 'The combination of User ID and Poll ID has already been taken.'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['poll_id'], 'exist', 'skipOnError' => true, 'targetClass' => Polls::className(), 'targetAttribute' => ['poll_id' => 'poll_id']],
            [['poll_answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => PollsAnswers::className(), 'targetAttribute' => ['poll_answer_id' => 'poll_answer_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'polls_history_id' => 'Polls History ID',
            'user_id' => 'User ID',
            'poll_id' => 'Poll ID',
            'poll_answer_id' => 'Poll Answer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
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
    public function getPollAnswer()
    {
        return $this->hasOne(PollsAnswers::className(), ['poll_answer_id' => 'poll_answer_id']);
    }
}
