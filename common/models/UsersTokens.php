<?php

namespace common\models;

use Yii;
use yii\pinxter\chats\models\interfaces\ChatSessionInterface;
use yii\web\IdentityInterface;
use yii\pinxter\chats\models\interfaces\ChatUserInterface;
use yii\pinxter\chats\models\ChatsUsersInfo;
use yii\pinxter\chats\models\Chat;
use yii\db\Query;

/**
 * This is the model class for table "users_tokens".
 *
 * @property integer $users_tokens_id
 * @property integer $user_id
 * @property string $token
 * @property integer $time
 * @property string $device_id
 */
class UsersTokens extends \common\models\generated\UsersTokens implements IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $u = static::findOne([
            'token'     => $token,
            'device_id' => Yii::$app->request->headers->get('device-id'),
        ]);
        return $u;
    }

    public static function findByUsername($username)
    {
        return null;
    }

    public static function findIdentity($id)
    {
        return null;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return ChatUserInterface
     */
    public function getChatUser()
    {
        return $this->user;
    }
}
