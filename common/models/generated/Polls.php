<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "polls".
 *
 * @property integer $poll_id
 * @property integer $user_id
 * @property integer $poll_date
 * @property integer $poll_status
 * @property string $poll_text
 *
 * @property Users $user
 * @property PollsAnswers[] $pollsAnswers
 * @property PollsHistory[] $pollsHistories
 */
class Polls extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'polls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'poll_date', 'poll_text'], 'required'],
            [['user_id', 'poll_date', 'poll_status'], 'integer'],
            [['poll_text'], 'string', 'max' => 2048],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'poll_id' => 'Poll ID',
            'user_id' => 'User ID',
            'poll_date' => 'Poll Date',
            'poll_status' => 'Poll Status',
            'poll_text' => 'Poll Text',
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
    public function getPollsAnswers()
    {
        return $this->hasMany(PollsAnswers::className(), ['poll_id' => 'poll_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollsHistories()
    {
        return $this->hasMany(PollsHistory::className(), ['poll_id' => 'poll_id']);
    }
}
