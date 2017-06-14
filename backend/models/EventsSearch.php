<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Events;

/**
 * EventsSearch represents the model behind the search form about `common\models\Events`.
 */
class EventsSearch extends Events
{
    const GRID_SIZE = 20;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'event_start', 'event_end', 'category_id', 'event_status'], 'integer'],
            [['event_title', 'event_description', 'event_image', 'event_country', 'event_state', 'event_city', 'event_zip', 'event_place', 'event_address', 'event_help_link'], 'safe'],
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
                    'event_id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => self::GRID_SIZE
            ],
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'event_id'     => $this->event_id,
            //timestamp в базе конвертится по часовому поясу базы ...
            //            'FROM_UNIXTIME(event_start, "%Y-%m-%d")' => $this->event_start ? \DateTime::createFromFormat('d M Y', $this->event_start)->format('Y-m-d') : null,
            //            'FROM_UNIXTIME(event_end, "%Y-%m-%d")'   => $this->event_end ? \DateTime::createFromFormat('d M Y', $this->event_end)->format('Y-m-d') : null,
            'category_id'  => $this->category_id,
            'event_status' => $this->event_status,
        ]);

        if (!empty($this->event_start)) {
            $dt = \DateTime::createFromFormat('d M Y', $this->event_start)->modify('today');
            $query->andFilterWhere(['between', 'event_start', $dt->getTimestamp(), $dt->getTimestamp() + (24 * 3600)]);
        }

        if (!empty($this->event_end)) {
            $dt = \DateTime::createFromFormat('d M Y', $this->event_end)->modify('today');
            $query->andFilterWhere(['between', 'event_end', $dt->getTimestamp(), $dt->getTimestamp() + (24 * 3600)]);
        }

        $query->andFilterWhere(['like', 'event_title', $this->event_title])
            ->andFilterWhere(['like', 'event_description', $this->event_description])
            ->andFilterWhere(['like', 'event_image', $this->event_image])
            ->andFilterWhere(['like', 'event_country', $this->event_country])
            ->andFilterWhere(['like', 'event_state', $this->event_state])
            ->andFilterWhere(['like', 'event_city', $this->event_city])
            ->andFilterWhere(['like', 'event_zip', $this->event_zip])
            ->andFilterWhere(['like', 'event_place', $this->event_place])
            ->andFilterWhere(['like', 'event_address', $this->event_address])
            ->andFilterWhere(['like', 'event_help_link', $this->event_help_link]);

        return $dataProvider;
    }
}
