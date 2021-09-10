<?php

namespace backend\models\filters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\tables\Games;

/**
 * GamesFilter represents the model behind the search form of `app\models\tables\Games`.
 */
class GamesFilter extends Games
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'home_id', 'visitor_id', 'home_goals', 'visitor_goals'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Games::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'home_id' => $this->home_id,
            'visitor_id' => $this->visitor_id,
            'date' => $this->date,
            'home_goals' => $this->home_goals,
            'visitor_goals' => $this->visitor_goals,
        ]);

        return $dataProvider;
    }
}
