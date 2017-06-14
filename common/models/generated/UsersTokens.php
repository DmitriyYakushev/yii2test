<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "users_tokens".
 *
 * @property integer $users_tokens_id
 * @property integer $user_id
 * @property string $token
 * @property integer $time
 * @property string $device_id
 */
class UsersTokens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'token', 'time', 'device_id'], 'required'],
            [['user_id', 'time'], 'integer'],
            [['token'], 'string', 'max' => 128],
            [['device_id'], 'string', 'max' => 50],
            [['token'], 'unique'],
            [['user_id', 'device_id'], 'unique', 'targetAttribute' => ['user_id', 'device_id'], 'message' => 'The combination of User ID and Device ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'users_tokens_id' => 'Users Tokens ID',
            'user_id' => 'User ID',
            'token' => 'Token',
            'time' => 'Time',
            'device_id' => 'Device ID',
        ];
    }
}
