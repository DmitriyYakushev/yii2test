<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "News".
 *
 * @property integer $news_id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property string $img_url
 * @property integer $news_date
 * @property EventCategories $category
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'description', 'img_url'], 'required'],
            [['text'], 'string'],
            [['news_id', 'user_id'], 'integer'],
            [['news_date'], 'filter', 'filter' => function ($value) {
                $date_news = \DateTime::createFromFormat('j-M-Y', $value);
                return $date_news ? $date_news->getTimestamp() : null;
            }],
            [['title', 'description', 'img_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'text' => 'News Text',
            'img_url' => 'Image URL',
            'news_date' => 'News Date',
        ];
    }
}
