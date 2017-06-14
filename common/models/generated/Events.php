<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property integer $event_id
 * @property string $event_title
 * @property string $event_description
 * @property integer $event_start
 * @property integer $event_end
 * @property string $event_image
 * @property string $event_country
 * @property string $event_state
 * @property string $event_city
 * @property string $event_zip
 * @property integer $category_id
 * @property integer $event_status
 *
 * @property EventCategories $category
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_title', 'event_description', 'event_start', 'event_end', 'event_image', 'event_country', 'event_state', 'event_city', 'event_zip', 'category_id', 'event_status'], 'required'],
            [['event_description'], 'string'],
            [['event_start', 'event_end', 'category_id', 'event_status'], 'integer'],
            [['event_title', 'event_image', 'event_city'], 'string', 'max' => 255],
            [['event_country'], 'string', 'max' => 2],
            [['event_state'], 'string', 'max' => 100],
            [['event_zip'], 'string', 'max' => 10],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventCategories::className(), 'targetAttribute' => ['category_id' => 'category_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_id' => 'Event ID',
            'event_title' => 'Event Title',
            'event_description' => 'Event Description',
            'event_start' => 'Event Start',
            'event_end' => 'Event End',
            'event_image' => 'Event Image',
            'event_country' => 'Event Country',
            'event_state' => 'Event State',
            'event_city' => 'Event City',
            'event_zip' => 'Event Zip',
            'category_id' => 'Category ID',
            'event_status' => 'Event Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(EventCategories::className(), ['category_id' => 'category_id']);
    }
}
