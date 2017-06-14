<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Users;

/**
 * UsersSearch represents the model behind the search form about `common\models\Users`.
 */
class UsersSearch extends Users
{
    const GRID_SIZE = 20;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_status', 'user_created', 'user_updated', 'user_hide_location'], 'integer'],
            [['user_login', 'user_password', 'user_fname', 'user_lname', 'user_logo', 'user_state', 'user_city', 'user_company', 'user_description', 'user_occupation', 'user_industry'], 'safe'],
            [['user_lat', 'user_long'], 'number'],
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

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => [
                'defaultOrder' => [
                    'user_id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => self::GRID_SIZE
            ],
        ]);

        $this->load($params);

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id'            => $this->user_id,
            'user_status'        => $this->user_status,
            'user_created'       => $this->user_created,
            'user_updated'       => $this->user_updated,
            'user_lat'           => $this->user_lat,
            'user_long'          => $this->user_long,
            'user_hide_location' => $this->user_hide_location,
        ]);

        $query->andFilterWhere(['like', 'user_login', $this->user_login])
            ->andFilterWhere(['like', 'user_password', $this->user_password])
            ->andFilterWhere(['like', 'user_fname', $this->user_fname])
            ->andFilterWhere(['like', 'user_lname', $this->user_lname])
            ->andFilterWhere(['like', 'user_logo', $this->user_logo])
            ->andFilterWhere(['like', 'user_state', $this->user_state])
            ->andFilterWhere(['like', 'user_city', $this->user_city])
            ->andFilterWhere(['like', 'user_company', $this->user_company])
            ->andFilterWhere(['like', 'user_description', $this->user_description])
            ->andFilterWhere(['like', 'user_occupation', $this->user_occupation])
            ->andFilterWhere(['like', 'user_industry', $this->user_industry]);

        return $dataProvider;
    }
}
