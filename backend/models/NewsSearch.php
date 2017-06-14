<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\News;

/**
 * NewsSearchModel represents the model behind the search form about `common\models\News`.
 */
class NewsSearch extends News
{
    const GRID_SIZE = 20;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'user_id', 'news_date', 'pin_to_top', 'news_type', 'news_status'], 'integer'],
            [['news_title', 'news_text', 'news_link', 'news_image', 'news_video', 'news_video_code'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => [
                'defaultOrder' => [
                    'news_id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => self::GRID_SIZE
            ],
        ]);

        $this->load($params);

        // grid filtering conditions
        $query->andFilterWhere([
            'news_id'     => $this->news_id,
            'user_id'     => $this->user_id,
            'news_date'   => $this->news_date,
            'pin_to_top'  => $this->pin_to_top,
            'news_type'   => $this->news_type,
            'news_status' => $this->news_status,
        ]);

        $query->andFilterWhere(['like', 'news_title', $this->news_title])
            ->andFilterWhere(['like', 'news_text', $this->news_text])
            ->andFilterWhere(['like', 'news_link', $this->news_link])
            ->andFilterWhere(['like', 'news_image', $this->news_image])
            ->andFilterWhere(['like', 'news_video', $this->news_video])
            ->andFilterWhere(['like', 'news_video_code', $this->news_video_code]);

        return $dataProvider;
    }
}
