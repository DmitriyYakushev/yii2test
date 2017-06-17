<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property integer $user_status
 * @property string $user_login
 * @property string $user_password
 * @property string $user_fname
 * @property string $user_lname
 * @property string $user_logo
 * @property integer $user_created
 * @property integer $user_updated
 * @property string $user_state
 * @property string $user_city
 * @property string $user_company
 * @property string $user_description
 * @property string $user_occupation
 * @property string $user_industry
 * @property double $user_lat
 * @property double $user_long
 * @property integer $user_hide_location
 *
 * @property UserEvents[] $eventUsers
 * @property Events[] $events
 * @property ForumFollow[] $forumFollows
 * @property Forums[] $forums
 * @property ForumReplies[] $forumReplies
 * @property ForumRepliesUpvote[] $forumRepliesUpvotes
 * @property ForumReplies[] $forumReplies0
 * @property Forums[] $forums0
 * @property News[] $news
 * @property Polls[] $polls
 * @property PollsHistory[] $pollsHistories
 * @property Polls[] $polls0
 * @property Uploads[] $uploads
 * @property UsersFollow[] $usersFollows
 * @property UsersFollow[] $usersFollows0
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_status', 'user_created', 'user_updated', 'user_hide_location'], 'integer'],
            [['user_login', 'user_password', 'user_fname', 'user_lname', 'user_created', 'user_updated'], 'required'],
            [['user_description'], 'string'],
            [['user_lat', 'user_long'], 'number'],
            [['user_login', 'user_fname', 'user_lname', 'user_city'], 'string', 'max' => 50],
            [['user_password', 'user_company'], 'string', 'max' => 100],
            [['user_logo'], 'string', 'max' => 1024],
            [['user_state'], 'string', 'max' => 10],
            [['user_occupation', 'user_industry'], 'string', 'max' => 255],
            [['user_login'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_status' => 'User Status',
            'user_login' => 'User Login',
            'user_password' => 'User Password',
            'user_fname' => 'User Fname',
            'user_lname' => 'User Lname',
            'user_logo' => 'User Logo',
            'user_created' => 'User Created',
            'user_updated' => 'User Updated',
            'user_state' => 'User State',
            'user_city' => 'User City',
            'user_company' => 'User Company',
            'user_description' => 'User Description',
            'user_occupation' => 'User Occupation',
            'user_industry' => 'User Industry',
            'user_lat' => 'User Lat',
            'user_long' => 'User Long',
            'user_hide_location' => 'User Hide Location',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventUsers()
    {
        return $this->hasMany(UserEvents::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['event_id' => 'event_id'])->viaTable('user_events', ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForumFollows()
    {
        return $this->hasMany(ForumFollow::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForums()
    {
        return $this->hasMany(Forums::className(), ['forum_id' => 'forum_id'])->viaTable('forum_follow', ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForumReplies()
    {
        return $this->hasMany(ForumReplies::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForumRepliesUpvotes()
    {
        return $this->hasMany(ForumRepliesUpvote::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForumReplies0()
    {
        return $this->hasMany(ForumReplies::className(), ['forum_reply_id' => 'forum_reply_id'])->viaTable('forum_replies_upvote', ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForums0()
    {
        return $this->hasMany(Forums::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolls()
    {
        return $this->hasMany(Polls::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollsHistories()
    {
        return $this->hasMany(PollsHistory::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolls0()
    {
        return $this->hasMany(Polls::className(), ['poll_id' => 'poll_id'])->viaTable('polls_history', ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUploads()
    {
        return $this->hasMany(Uploads::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersFollows()
    {
        return $this->hasMany(UsersFollow::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersFollows0()
    {
        return $this->hasMany(UsersFollow::className(), ['follow_id' => 'user_id']);
    }
}
