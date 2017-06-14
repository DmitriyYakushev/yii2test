<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "event_categories".
 *
 * @property integer $category_id
 * @property string $category_name
 * @property string $category_icon
 * @property integer $category_status
 * @property integer $category_sort
 *
 * @property Events[] $events
 */
class EventCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name', 'category_icon'], 'required'],
            [['category_status', 'category_sort'], 'integer'],
            [['category_name', 'category_icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'category_icon' => 'Category Icon',
            'category_status' => 'Category Status',
            'category_sort' => 'Category Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['category_id' => 'category_id']);
    }
}
