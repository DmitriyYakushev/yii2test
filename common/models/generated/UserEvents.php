<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "user_events".
 *
 * @property integer $event_id
 * @property integer $user_id
 */
class UserEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'user_id'], 'required'],
            [['event_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_id' => 'Event ID',
            'user_id' => 'User ID',
        ];
    }
}
