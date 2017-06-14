<?php

namespace common\models;

use yii\behaviors\AttributeTypecastBehavior;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\pinxter\chats\models\Chat;
use yii\pinxter\chats\models\ChatsUsersInfo;
use yii\pinxter\chats\models\interfaces\ChatUserInterface;

class Users extends \common\models\generated\Users 
{
    const API_SCENARIO_CREATE = "create";
    const API_SCENARIO_UPDATE = "update";

    const USER_STATUS_DELETED = 0;
    const USER_STATUS_ACTIVE  = 1;
    const USER_STATUS_ADMIN   = 2;

    public static function readableStatuses()
    {
        return [
            self::USER_STATUS_DELETED => 'deleted',
            self::USER_STATUS_ACTIVE  => 'active',
            self::USER_STATUS_ADMIN   => 'admin'
        ];
    }

    public function readableStatus()
    {
        $statuses = self::readableStatuses();
        return isset($statuses[$this->user_status]) ? $statuses[$this->user_status] : null;
    }

    public function scenarios()
    {
        $scenarion                            = parent::scenarios();
        $scenarion[self::API_SCENARIO_UPDATE] = [
            'user_fname', 'user_lname', 'user_logo', 'user_password', 'user_company',
            'user_description', 'user_occupation', 'user_hide_location', 'user_lat', 'user_long',
            'user_city', 'user_state', 'user_industry'
        ];

        return $scenarion;
    }

    public function rules()
    {
        $rules   = parent::rules();
        $rules[] = [['user_hide_location'], 'in', 'range' => [0, 1]];
        $rules[] = ['user_login', 'email'];
        return $rules;
    }

    public function behaviors()
    {
        return [
            'typecast' => [
                'class' => AttributeTypecastBehavior::className(),
                // 'attributeTypes' will be composed automatically according to `rules()`
            ],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        /**
         * show more fields in view by default
         */
        if (in_array(\Yii::$app->controller->action->uniqueId, ['users/view', 'users/me', 'users/update'])) {
            $fields                  = ['user_id', 'user_fname', 'user_lname', 'user_logo', 'user_company', 'user_occupation', 'user_description', 'user_created', 'user_occupation',
                                        'user_hide_location', 'user_lat', 'user_long', 'user_city', 'user_state', 'user_industry'];
            $fields['follow_status'] = function ($model) {
                if ($model->follow) {
                    return $model->follow->follow_status;
                } else {
                    return 0;
                }
            };
            $fields['follow_note']   = function ($model) {
                if ($model->follow) {
                    return $model->follow->follow_note;
                } else {
                    return '';
                }
            };
        } else {
            $fields = ['user_id', 'user_fname', 'user_lname', 'user_logo', 'user_company', 'user_occupation', 'user_city', 'user_state', 'user_industry'];
        }

        return $fields;
    }

    public function extraFields()
    {
        return ['user_hide_location', 'user_lat', 'user_long'];
    }

    public function afterFind()
    {
        if (!$this->user_logo) {
            $this->user_logo = Settings::findOne(['setting_name' => 'default_logo'])->setting_value;
        }
    }

    public function getFollow()
    {
        return $this->hasOne(UsersFollow::className(), ['follow_id' => 'user_id'])->where(['users_follow.user_id' => \Yii::$app->user->id]);
    }

    public function validatePassword($password)
    {
        return $this->user_password === $password;
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->user_created = time();
            $this->user_updated = time();
        }
        if ($this->scenario == self::API_SCENARIO_UPDATE) {
            $this->user_updated = time();
        }
        if ($this->user_logo == Settings::findOne(['setting_name' => 'default_logo'])->setting_value) {
            $this->user_logo = null;
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!$this->user_logo) {
            $this->user_logo = Settings::findOne(['setting_name' => 'default_logo'])->setting_value;
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    public function setPassword($password)
    {
        $this->user_password = $password;
        return $this->save(true, ['user_password']);
    }

    /**
     * @return mixed primary key
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @return string secret key for user
     */
    public function getChannelSecret()
    {
        return $this->user_id;
    }

    /**
     * @return string Full name of user
     */
    public function getFullName()
    {
        return $this->user_fname . " " . $this->user_lname;
    }

    /**
     * @return string image of user
     */
    public function getImage()
    {
        return $this->user_logo;
    }

    /**
     *
     * @return ActiveQuery with only active (visible for this user) instances of Chat
     */
    public function getActiveChats()
    {
        return $this->hasMany(Chat::className(), ['id' => 'chat_id'])
            ->viaTable(
                ChatsUsersInfo::tableName(), ['user_id' => 'user_id'],
                function (Query $query) {
                    $query->where(['active' => true]);
                }
            );
    }

    /**
     * @return ActiveQuery with instances of ChatsInfo
     */
    public function getChatsInfo()
    {
        return $this->hasMany(ChatsUsersInfo::className(), ['user_id' => 'user_id']);
    }
}
