<?php

namespace app\models\filters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Teams;

/**
 * TeamsFilter represents the model behind the search form of `app\models\tables\Teams`.
 */
class TeamsFilter extends Teams
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'games', 'gf', 'ga', 'points'], 'integer'],
            [['name'], 'safe'],
            [['logo_source'], 'string'],
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
        $query = Teams::find();

        // add conditions that should always apply here
        // В публичной части выводим команды по количеству очков
        if (\Yii::$app->controller->id == 'site'){
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort'=>[
                    'defaultOrder'=>[
                        'points'=>SORT_DESC
                    ]
                ]
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'games' => $this->games,
            'gf' => $this->gf,
            'ga' => $this->ga,
            'points' => $this->points,
            'logo_source' => $this->logo_source,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
