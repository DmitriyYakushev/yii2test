<?php

namespace backend\models;

use common\models\generated\News;
use yii\data\ActiveDataProvider;

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
            [['news_id', 'user_id', 'news_date'], 'integer'],
            [['title', 'description', 'img_url'], 'required'],
            [['title', 'description', 'text', 'img_url'], 'safe'],
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
            'query' => $query,
            'sort' => [
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
            'news_id' => $this->news_id,
            'user_id' => $this->user_id,
        ]);

        if (!empty($this->news_date)) {
            $news_date = \DateTime::createFromFormat('j-M-Y', $this->news_date)->modify('today');
            $query->andFilterWhere(['between', 'news_date', $news_date->getTimestamp(), $news_date->getTimestamp() + (24 * 3600)]);
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
