<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "users_follow".
 *
 * @property integer $users_follow_id
 * @property integer $user_id
 * @property integer $follow_id
 * @property integer $follow_status
 * @property string $follow_note
 *
 * @property Users $user
 * @property Users $follow
 */
class UsersFollow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_follow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'follow_id'], 'required'],
            [['user_id', 'follow_id', 'follow_status'], 'integer'],
            [['follow_note'], 'string', 'max' => 4048],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['follow_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['follow_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'users_follow_id' => 'Users Follow ID',
            'user_id' => 'User ID',
            'follow_id' => 'Follow ID',
            'follow_status' => 'Follow Status',
            'follow_note' => 'Follow Note',
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
    public function getFollow()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'follow_id']);
    }
}
