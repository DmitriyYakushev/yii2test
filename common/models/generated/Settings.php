<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property string $setting_name
 * @property string $setting_value
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting_name', 'setting_value'], 'required'],
            [['setting_value'], 'string'],
            [['setting_name'], 'string', 'max' => 50],
            [['setting_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting_name' => 'Setting Name',
            'setting_value' => 'Setting Value',
        ];
    }
}
