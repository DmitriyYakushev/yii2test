<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Polls;

/**
 * PollsSearch represents the model behind the search form about `common\models\Polls`.
 */
class PollsSearch extends Polls
{
    const GRID_SIZE = 20;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poll_id', 'user_id', 'poll_date', 'poll_status'], 'integer'],
            [['poll_text'], 'safe'],
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
        $query = Polls::find();

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => [
                'defaultOrder' => [
                    'poll_id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => self::GRID_SIZE
            ],
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'poll_id'     => $this->poll_id,
            'user_id'     => $this->user_id,
            'poll_status' => $this->poll_status,
        ]);

        if (!empty($this->poll_date)) {
            $dt = \DateTime::createFromFormat('d M Y', $this->poll_date)->modify('today');
            $query->andFilterWhere(['between', 'poll_date', $dt->getTimestamp(), $dt->getTimestamp() + (24 * 3600)]);
        }

        $query->andFilterWhere(['like', 'poll_text', $this->poll_text]);

        return $dataProvider;
    }
}
