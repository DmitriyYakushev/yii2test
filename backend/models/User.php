<?php

namespace backend\models;

use common\models\Users;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

class User extends Users implements IdentityInterface
{
    public static function findByUsername($name)
    {
        return static::find()->where(['user_login' => $name])->andWhere(['user_status' => self::USER_STATUS_ADMIN])->one();
    }

    public static function copyFromAdmin(Admin $admin)
    {
        $user = new static();

        $user->user_login    = $admin->name;
        $user->user_fname    = $admin->name;
        $user->user_password = $admin->password;
        $user->user_logo     = $admin->logo_url;
        $user->user_status   = self::USER_STATUS_ADMIN;

        return $user;
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'user_created',
                'updatedAtAttribute' => 'user_updated',
            ]
        ]);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id, 'user_status' => self::USER_STATUS_ADMIN]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function validatePassword($password)
    {
        return $password==$this->user_password;
    }

    public function getAuthKey()
    {
        return sha1($this->user_login . $this->user_password);
    }

    public function validateAuthKey($authKey)
    {
        return sha1($this->user_login . $this->user_password) == $authKey;
    }
}