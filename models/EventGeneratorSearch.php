<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EventGenerator;

/**
 * EventGeneratorSearch represents the model behind the search form of `app\models\EventGenerator`.
 */
class EventGeneratorSearch extends EventGenerator
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'organizer_id', 'credit', 'event_fees'], 'integer'],
            [['event_name', 'description', 'result_link'], 'safe'],
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
        $query = EventGenerator::find();

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
            'event_id' => $this->event_id,
            'organizer_id' => $this->organizer_id,
            'credit' => $this->credit,
        ]);

        $query->andFilterWhere(['like', 'event_name', $this->event_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'event_fees', $this->event_fees])
            ->andFilterWhere(['like', 'result_link', $this->result_link]);

        return $dataProvider;
    }
}
