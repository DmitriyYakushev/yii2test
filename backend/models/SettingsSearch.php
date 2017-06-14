<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Settings;

/**
 * SettingsSearch represents the model behind the search form about `common\models\Settings`.
 */
class SettingsSearch extends Settings
{
    const GRID_SIZE = 20;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting_name', 'setting_value'], 'safe'],
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
        $query = SettingsSearch::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => [
                'defaultOrder' => [
                    'setting_name' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => self::GRID_SIZE
            ],
        ]);

        $this->load($params);

        // grid filtering conditions
        $query->andFilterWhere(['like', 'setting_name', $this->setting_name])
            ->andFilterWhere(['like', 'setting_value', $this->setting_value]);

        return $dataProvider;
    }
}
